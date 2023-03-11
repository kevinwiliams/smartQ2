<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Mail\ScheduledReportNotification;
use App\Mail\TokenNotification;
use App\Models\DepartmentStats;
use Illuminate\Http\Request;
use App\Models\Display;
use App\Models\DisplaySetting;
use App\Models\Location;
use App\Models\LocationStats;
use App\Models\ScheduledReportsTask;
use Carbon\Carbon;
use App\Models\SmsSetting;
use App\Models\SmsHistory;
use App\Models\Token;
use App\Models\User;
use App\Models\UserStats;
use DB, Response, File, Validator;
use Illuminate\Support\Facades\Log;
use Kutia\Larafirebase\Facades\Larafirebase;
use Mail;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use PDF;

class CronjobController extends Controller
{
    public function sms()
    {
        $setting = DisplaySetting::first();

        if ($setting->display == 5) {
            //display 5: hospital queue - like display 2
            return $this->display3();
        } elseif ($setting->display == 4) {
            //display 4: department wise queue
            return $this->display4();
        } elseif ($setting->display == 3) {
            //display 3: counter wise queue 2
            return $this->display3();
        } elseif ($setting->display == 2) {
            //display 2: counter wise queue
            return $this->display3();
        } else {
            //display 1: single line queue
            return $this->display1();
        }
    }

    //single line q
    public function display1()
    {
        $activelocations = Location::where('active', 1)->has('departments')->with('settings')->whereRelation("company", "active", true)->get();

        foreach ($activelocations as $location) {
            $setting   = DisplaySetting::where('location_id', $location->id)->first();
            $tokenInfo = DB::table('token AS t')
                ->select(
                    "t.id",
                    "t.client_id AS client",
                    "t.token_no AS token",
                    "t.client_mobile AS mobile",
                    "d.name AS department",
                    "c.name AS counter",
                    DB::raw("CONCAT_WS(' ', o.firstname, o.lastname) as officer"),
                    "t.status",
                    "t.sms_status",
                    "t.created_at AS date",
                    "t.notification_type AS notification_type"
                )
                ->leftJoin("department AS d", "d.id", "=", "t.department_id")
                ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
                ->leftJoin("user AS o", "o.id", "=", "t.user_id")
                ->where("t.status", "0")
                ->where("t.location_id",  $location->id)
                ->orderBy('t.is_vip', 'DESC')
                ->orderBy('t.id', 'ASC')
                ->offset($setting->alert_position)
                ->limit(1)
                ->get();

            if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                if ($tokenInfo->notification_type == "sms") {
                    // send sms
                    $data['status'] = true;
                    $data['result'] = $tokenInfo;
                    $this->sendSMS($tokenInfo, $setting->alert_position);
                    $this->sendPushNotification($tokenInfo);
                } elseif ($tokenInfo->notification_type == "email") {
                    //Send email
                    $data['status'] = true;
                    $data['result'] = $tokenInfo;
                    // send Email 
                    $this->sendEmail($tokenInfo);
                    $this->sendPushNotification($tokenInfo);
                } elseif ($tokenInfo->notification_type == "whatsapp") {
                    $data['status'] = true;
                    $data['result'] = $tokenInfo;
                    $this->sendWhatsAppNotification($tokenInfo, $setting->alert_position);
                }
            }
            // if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
            //     // send sms
            //     $data['status'] = true;
            //     $data['result'] = $tokenInfo;
            //     $this->sendSMS($tokenInfo, $setting->alert_position);
            //     $this->sendPushNotification($tokenInfo);
            // } else {
            // }
        }

        return Response::json($data);
    }

    //counter wise 
    public function display3()
    {
        $activelocations = Location::where('active', 1)->has('departments')->with('settings')->whereRelation("company", "active", true)->get();

        foreach ($activelocations as $location) {
            $setting   = DisplaySetting::where('location_id', $location->id)->first();

            $counters = DB::table('counter')
                ->where('status', 1)
                ->where('location_id', $location->id)
                ->orderBy('name', 'ASC')
                ->get();

            $allToken = array();
            $data     = array();
            foreach ($counters as $counter) {
                $tokens = DB::table('token AS t')
                    ->select(
                        "t.id",
                        "t.token_no AS token",
                        "t.client_id AS client",
                        "t.client_mobile AS mobile",
                        "d.name AS department",
                        "c.name AS counter",
                        DB::raw("CONCAT_WS(' ', o.firstname, o.lastname) as officer"),
                        "t.status",
                        "t.sms_status",
                        "t.created_at",
                        "t.notification_type AS notification_type"
                    )
                    ->leftJoin("department AS d", "d.id", "=", "t.department_id")
                    ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
                    ->leftJoin("user AS o", "o.id", "=", "t.user_id")
                    ->where("t.counter_id", $counter->id)
                    ->where("t.location_id",  $location->id)
                    ->where("t.status", "0")
                    ->offset($setting->alert_position)
                    ->orderBy('t.is_vip', 'DESC')
                    ->orderBy('t.id', 'ASC')
                    ->limit(1)
                    ->get();

                foreach ($tokens as $token) {
                    $allToken[$counter->name] = (object)array(
                        'id'         => $token->id,
                        'token'      => $token->token,
                        'department' => $token->department,
                        'counter'    => $token->counter,
                        'officer'    => $token->officer,
                        'mobile'     => $token->mobile,
                        'date'       => $token->created_at,
                        'status'     => $token->status,
                        'sms_status' => $token->sms_status,
                        'notification_type' => $token->notification_type,
                    );
                }
            }

            foreach ($allToken as $counter => $tokenInfo) {
                if ($tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                    if ($tokenInfo->notification_type == "sms" && !empty($tokenInfo->mobile)) {
                        // send sms
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        $this->sendSMS($tokenInfo, $setting->alert_position);
                        $this->sendPushNotification($tokenInfo);
                    } elseif ($tokenInfo->notification_type == "email") {
                        //Send email
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        // send Email 
                        $this->sendEmail($tokenInfo);
                        $this->sendPushNotification($tokenInfo);
                    } elseif ($tokenInfo->notification_type == "whatsapp") {
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        $this->sendWhatsAppNotification($tokenInfo, $setting->alert_position);
                    } else {
                        //Send email
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        // send Email 
                        $this->sendEmail($tokenInfo);
                        $this->sendPushNotification($tokenInfo);
                    }
                }
            }
        }
        return Response::json($data);
    }

    //department wise 
    public function display4()
    {
        $activelocations = Location::where('active', 1)->has('departments')->with('settings')->whereRelation("company", "active", true)->get();

        foreach ($activelocations as $location) {
            $setting   = DisplaySetting::where('location_id', $location->id)->first();
            $departments = DB::table('department')
                ->where('status', 1)
                ->where('location_id', $location->id)
                ->orderBy('name', 'ASC')
                ->get();

            $allToken = array();
            $data     = array();
            foreach ($departments as $department) {
                $tokens = DB::table('token AS t')
                    ->select(
                        "t.id",
                        "t.token_no AS token",
                        "t.client_id AS client",
                        "t.client_mobile AS mobile",
                        "d.name AS department",
                        "c.name AS counter",
                        DB::raw("CONCAT_WS(' ', o.firstname, o.lastname) as officer"),
                        "t.status",
                        "t.sms_status",
                        "t.created_at",
                        "t.notification_type AS notification_type"
                    )
                    ->leftJoin("department AS d", "d.id", "=", "t.department_id")
                    ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
                    ->leftJoin("user AS o", "o.id", "=", "t.user_id")
                    ->where("t.department_id", $department->id)
                    ->where('t.location_id', $location->id)
                    ->where("t.status", "0")
                    ->orderBy('t.is_vip', 'DESC')
                    ->orderBy('t.id', 'ASC')
                    ->offset($setting->alert_position)
                    ->limit(1)
                    ->get();

                foreach ($tokens as $token) {
                    $allToken[$department->name] = (object)array(
                        'id'         => $token->id,
                        'token'      => $token->token,
                        'department' => $token->department,
                        'counter'    => $token->counter,
                        'officer'    => $token->officer,
                        'mobile'     => $token->mobile,
                        'date'       => $token->created_at,
                        'status'     => $token->status,
                        'sms_status' => $token->sms_status,
                        'notification_type' => $token->notification_type,
                    );
                }
            }

            foreach ($allToken as $counter => $tokenInfo) {
                if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                    if ($tokenInfo->notification_type == "sms") {
                        // send sms
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        $this->sendSMS($tokenInfo, $setting->alert_position);
                        $this->sendPushNotification($tokenInfo);
                    } elseif ($tokenInfo->notification_type == "email") {
                        //Send email
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        // send Email 
                        $this->sendEmail($tokenInfo);
                        $this->sendPushNotification($tokenInfo);
                    } elseif ($tokenInfo->notification_type == "whatsapp") {
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        $this->sendWhatsAppNotification($tokenInfo, $setting->alert_position);
                    }
                }
            }
        }

        return Response::json($data);
    }

    /*
    *---------------------------------------------------------
    * SEND SMS
    *--------------------------------------------------------- 
    */
    public function sendSMS($token, $alert_position = null)
    {
        date_default_timezone_set('America/Bogota');

        //send sms immediately
        $setting  = SmsSetting::first();

        $template = ($token->sms_status == 2) ? $setting->recall_sms_template : $setting->sms_template;

        $response = (new SMS_lib)
            ->provider("$setting->provider")
            ->api_key("$setting->api_key")
            ->username("$setting->username")
            ->password("$setting->password")
            ->from("$setting->from")
            ->to($token->mobile)
            ->message($template, array(
                'TOKEN'  => $token->token,
                'MOBILE' => $token->mobile,
                'DEPARTMENT' => $token->department,
                'COUNTER' => $token->counter,
                'OFFICER' => $token->officer,
                'DATE'   => $token->date,
                'WAIT'   => $alert_position
            ))
            ->response();

        $api = json_decode($response, true);

        //store sms information 
        $sms = new SmsHistory;
        $sms->from        = $setting->from;
        $sms->to          = $token->mobile;
        $sms->message     = $api['message'];
        $sms->response    = $response;
        $sms->created_at  = date('Y-m-d H:i:s');
        $sms->save();

        //SMS SENT
        Token::where('id', $token->id)->update(['sms_status' => 1]);
    }

    /*
    *---------------------------------------------------------
    * SEND Email
    *--------------------------------------------------------- 
    */
    public function sendEmail($token)
    {
        //send Email immediately

        $client = User::find($token->client);
        if ($client) {
            Mail::to()->send(new TokenNotification($client, $token));

            Token::where('id', $token->id)->update(['sms_status' => 1]);
        }
    }

    /*
    *---------------------------------------------------------
    * SEND Push Notification
    *--------------------------------------------------------- 
    */
    public function sendPushNotification($token)
    {
        //send Email immediately

        $client = User::find($token->client);
        if ($client) {

            // return Larafirebase::withTitle('Test Title')
            // ->withBody('Test body')
            // ->withImage('https://firebase.google.com/images/social.png')
            // ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            // ->withClickAction('notifications')
            // ->withPriority('high')
            // ->withAdditionalData([
            //     'routing_key' => 'some_screen',
            //     'routing_value' => 42
            // ])
            // ->sendNotification($this->deviceTokens);

            // Or

            if ($client->push_notifications && $client->user_token != null) {
                $deviceTokens = [$client->user_token];
                $body = "Token No: $token->token,<br />
                Department: $token->department, Counter: $token->counter and Officer: $token->officer. <br />
                Your waiting no is $token->token.<br />
                $token->date.";

                Larafirebase::fromArray(['title' => 'SmartQ Notification', 'body' => $body])->sendNotification($deviceTokens);

                //SMS SENT
                Token::where('id', $token->id)->update(['push_notifications' => 1]);
            }
        }
    }

    public function generateDepartmentStats()
    {
        // date_default_timezone_set(session('app.timezone'));
        $tokens = Token::has('status')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->whereNotNull('started_at')
            ->get();

        $departments = array_unique($tokens->pluck('department_id')->toArray());


        foreach ($departments as $_dept) {
            $depttokens = $tokens->where('department_id', $_dept);
            $counter = 0;
            $total = 0;
            foreach ($depttokens as $_depttoken) {
                if ($_depttoken->wait_time != null) {
                    $total += $_depttoken->wait_time;
                    $counter++;
                }
                // echo '<pre>';
                // print_r($_depttoken->wait_time);
                // echo '</pre>';
            }

            $stat = DepartmentStats::where('department_id', $_dept)->first();
            if ($stat) {
                $stat->wait_time =  $total / $counter;
                $stat->updated_at = Carbon::now();
                $stat->update();
            } else {
                $save = DepartmentStats::insert([
                    'department_id'  => $_dept,
                    'wait_time'      => $total / $counter
                ]);
            }
        }
    }

    public function generateLocationStats()
    {
        // date_default_timezone_set(session('app.timezone'));
        $tokens = Token::has('status')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->whereNotNull('started_at')
            ->get();

        $locations = array_unique($tokens->pluck('location_id')->toArray());


        foreach ($locations as $_location) {
            $locationtokens = $tokens->where('location_id', $_location);
            $waitcounter = 0;
            $servicecounter = 0;
            $waittotal = 0;
            $servicetotal = 0;
            foreach ($locationtokens as $_locationtoken) {
                if ($_locationtoken->wait_time != null) {
                    $waittotal += $_locationtoken->wait_time;
                    $waitcounter++;
                }

                if ($_locationtoken->service_time != null) {
                    $servicetotal += $_locationtoken->service_time;
                    $servicecounter++;
                }
            }

            $stat = LocationStats::where('location_id', $_location)->first();
            if ($stat) {
                $stat->wait_time =  ($waitcounter > 0) ? ($waittotal / $waitcounter) : 0;
                $stat->service_time =  ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0;
                $stat->updated_at = Carbon::now();
                $stat->update();
            } else {
                $save = LocationStats::insert([
                    'location_id'  => $_location,
                    'wait_time'      => ($waitcounter > 0) ? ($waittotal / $waitcounter) : 0,
                    'service_time'      => ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0
                ]);
            }
        }
    }

    public function generateUserStats()
    {
        // date_default_timezone_set(session('app.timezone'));
        $tokens = Token::has('status')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->where('status', 1)
            ->get();

        $users = array_unique($tokens->pluck('user_id')->toArray());


        foreach ($users as $_user) {
            $locationtokens = $tokens->where('user_id', $_user);
            $waitcounter = 0;
            $servicecounter = 0;
            $waittotal = 0;
            $servicetotal = 0;
            foreach ($locationtokens as $_locationtoken) {
                if ($_locationtoken->wait_time != null) {
                    $waittotal += $_locationtoken->wait_time;
                    $waitcounter++;
                }

                if ($_locationtoken->service_time != null) {
                    $servicetotal += $_locationtoken->service_time;
                    $servicecounter++;
                }
            }

            $stat = UserStats::where('user_id', $_user)->first();
            if ($stat) {
                $stat->wait_time =  ($waitcounter > 0) ? ($waittotal / $waitcounter) : 0;
                $stat->service_time =  ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0;
                $stat->updated_at = Carbon::now();
                $stat->update();
            } else {
                $save = UserStats::insert([
                    'user_id'  => $_user,
                    'wait_time'      => ($waitcounter > 0) ? ($waittotal / $waitcounter) : 0,
                    'service_time'      => ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0
                ]);
            }
        }
    }

    public function generateScheduledReports()
    {
        $now = Carbon::now('America/Bogota')->second(0)->format('Y-m-d H:i:s');        
        $info = ScheduledReportsTask::whereRaw('run_time = \'' . $now . '\'')->get();
        
        foreach ($info as $value) {
            try {
                $jsondata = json_decode($value->report->schedule_info);

                $data = (object)array();
                $data->report = $value->report->report_id;
                $data->locations = $jsondata->locations;
                $data->daterange = $jsondata->date_range;
                $data->data = null;
                $data->graph = false;

                $start = Carbon::parse($value->run_time)->subDays($jsondata->range_start);
                $end = Carbon::parse($value->run_time)->subDays($jsondata->range_end);

                switch ($data->report) {
                    case '1':
                        $data->data = DB::table("token")
                            ->select(DB::raw("
                        locations.name AS 'location_name',
                        COUNT(token.`created_at`) AS 'total', 
                        HOUR(token.`created_at`) AS 'hour', 
                        DATE(token.`created_at`) AS 'day',
                        `location_id`
                        "))
                            ->join('locations', 'locations.id', '=', 'token.location_id')
                            ->whereIn('location_id', $data->locations)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->groupByRaw('DATE(token.`created_at`),HOUR(token.`created_at`),`location_id`,`location_name`')
                            ->orderByRaw('location_name', 'day', 'hour')
                            ->get();
                        break;
                    case '2':
                        $data->data = DB::table("token")
                            ->select(DB::raw("
                            locations.name AS 'location_name',
                            COUNT(token.`created_at`) AS 'total',                         
                            DATE(token.`created_at`) AS 'day',
                            `location_id`
                            "))
                            ->join('locations', 'locations.id', '=', 'token.location_id')
                            ->whereIn('location_id', $data->locations)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->groupByRaw('DATE(token.`created_at`),`location_id`,`location_name`')
                            ->orderByRaw('location_name', 'day')
                            ->get();
                        break;
                    case '3':
                        $data->data = DB::table("token")
                            ->select(DB::raw("
                                locations.name AS 'location_name',
                                COUNT(token.`created_at`) AS 'total',                         
                                WEEK(token.`created_at`) AS 'week',
                                YEAR(token.`created_at`) AS 'year',
                                `location_id`
                                "))
                            ->join('locations', 'locations.id', '=', 'token.location_id')
                            ->whereIn('location_id', $data->locations)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->groupByRaw('YEAR(token.`created_at`),WEEK(token.`created_at`),`location_id`,`location_name`')
                            ->orderByRaw('location_name', 'year', 'week')
                            ->get();
                        break;
                    case '4':

                        $info = DB::table("token")
                            ->select(DB::raw("
                                    locations.name AS 'location_name',
                                    COUNT(token.`created_at`) AS 'total',                         
                                    MONTH(token.`created_at`) AS 'month',
                                    YEAR(token.`created_at`) AS 'year',
                                    `location_id`
                                    "))
                            ->join('locations', 'locations.id', '=', 'token.location_id')
                            ->whereIn('location_id', $data->locations)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->groupByRaw('YEAR(token.`created_at`),MONTH(token.`created_at`),`location_id`,`location_name`')
                            ->orderByRaw('location_name', 'year', 'month')
                            ->get();
                        $data->data = $info;
                        $startDateUnix = strtotime($start);
                        $endDateUnix = strtotime($end);

                        $currentDateUnix = $startDateUnix;

                        $monthNumbers = array();
                        while ($currentDateUnix < $endDateUnix) {
                            // $weekNumbers[] = date('W', $currentDateUnix) . ' - ' . date('Y', $currentDateUnix);
                            array_push($monthNumbers, array('month' => date('m', $currentDateUnix), 'monthname' => date('M', $currentDateUnix), 'year' => date('Y', $currentDateUnix)));
                            $currentDateUnix = strtotime('+1 month', $currentDateUnix);
                        }

                        $seriesdata = array();

                        $locations = array_unique($info->pluck('location_name')->toArray());

                        foreach ($locations as $location_name) {
                            $datarow = array();
                            foreach ($monthNumbers as $_month) {

                                $inforow =  $info->where('year', $_month['year'])->where('location_name', $location_name)->where('month', $_month['month'])->first();
                                array_push($datarow, ($inforow) ? $inforow->total : 0);
                            }
                            array_push($seriesdata, array('name' => $location_name, 'data' => $datarow));
                        }
                        $data->graph = true;
                        $data->seriesdata = $seriesdata;

                        $categories = array();

                        foreach ($monthNumbers as $_month) {
                            array_push($categories, $_month['monthname'] . ' ' . $_month['year']);
                        }
                        $data->categories = $categories;

                        break;
                    case '5':
                        // date_default_timezone_set(session('app.timezone'));
                        $tokens = Token::has('status')
                            ->whereIn('location_id', $data->locations)
                            ->whereBetween('created_at', [$start, $end])
                            ->whereNotNull('started_at')
                            ->where('status', 1)
                            ->get();

                        $users = array_unique($tokens->pluck('user_id')->toArray());
                        $officers = User::whereIn('id', $users)->get();

                        $repdata = [];

                        foreach ($users as $_user) {
                            $currentOfficer = $officers->firstWhere('id', $_user);
                            $locationtokens = $tokens->where('user_id', $_user);
                            $waitcounter = 0;
                            $servicecounter = 0;
                            $waittotal = 0;
                            $servicetotal = 0;
                            $mintime = 0;
                            $maxtime = 0;

                            foreach ($locationtokens as $_locationtoken) {

                                if ($_locationtoken->wait_time != null) {
                                    $waittotal += $_locationtoken->wait_time;
                                    if ($mintime < $_locationtoken->wait_time || $waitcounter == 0)
                                        $mintime = $_locationtoken->wait_time;

                                    if ($maxtime > $_locationtoken->wait_time || $waitcounter == 0)
                                        $maxtime = $_locationtoken->wait_time;

                                    $waitcounter++;
                                }
                            }

                            $dataObj = [
                                "officer" => $currentOfficer->name,
                                "location" => $currentOfficer->location->name,
                                "avg" => ($waitcounter > 0) ? ($waittotal / $waitcounter) : 0,
                                "min" => $mintime,
                                "max" => $maxtime,
                                "total" => $waitcounter
                            ];
                            $repdata[] = (object)$dataObj;
                        }

                        $data->data = $repdata;

                        break;
                    case '6':
                        // date_default_timezone_set(session('app.timezone'));
                        $tokens = Token::has('status')
                            ->whereIn('location_id', $data->locations)
                            ->whereBetween('created_at', [$start, $end])
                            ->whereNotNull('started_at')
                            ->where('status', 1)
                            ->get();

                        $users = array_unique($tokens->pluck('user_id')->toArray());
                        $officers = User::whereIn('id', $users)->get();

                        $repdata = [];

                        foreach ($users as $_user) {
                            $currentOfficer = $officers->firstWhere('id', $_user);
                            $locationtokens = $tokens->where('user_id', $_user);
                            $servicecounter = 0;
                            $servicetotal = 0;
                            $mintime = 0;
                            $maxtime = 0;

                            foreach ($locationtokens as $_locationtoken) {

                                if ($_locationtoken->service_time != null) {
                                    $servicetotal += $_locationtoken->service_time;
                                    if ($mintime < $_locationtoken->service_time || $servicecounter == 0)
                                        $mintime = $_locationtoken->service_time;

                                    if ($maxtime > $_locationtoken->service_time || $servicecounter == 0)
                                        $maxtime = $_locationtoken->service_time;

                                    $servicecounter++;
                                }
                            }

                            $dataObj = [
                                "officer" => $currentOfficer->name,
                                "location" => $currentOfficer->location->name,
                                "avg" => ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0,
                                "min" => $mintime,
                                "max" => $maxtime,
                                "total" => $servicecounter
                            ];
                            $repdata[] = (object)$dataObj;
                        }

                        $data->data = $repdata;

                        break;
                    case '7':
                        $data->data = DB::table("token")
                            ->select(DB::raw("
                                locations.name AS 'location_name',
                                CONCAT_WS(' ', user.firstname, user.lastname) AS officer,
                                COUNT(token.`created_at`) AS 'total',                         
                                DATE(token.`created_at`) AS 'day',
                                token.`location_id`
                                "))
                            ->join('locations', 'locations.id', '=', 'token.location_id')
                            ->join('user', 'user.id', '=', 'token.user_id')
                            ->whereIn('token.location_id', $data->locations)
                            ->whereNotNull('started_at')
                            ->where('token.status', 2)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->groupByRaw('DATE(token.`created_at`),token.`location_id`,`location_name`,`officer`')
                            ->orderByRaw('location_name', 'officer', 'day')
                            ->get();

                        break;
                    case '8':
                        $data->data = DB::table("token")
                            ->select(DB::raw("
                                    locations.name AS 'location_name',
                                    CONCAT_WS(' ', user.firstname, user.lastname) AS officer,
                                    COUNT(token.`created_at`) AS 'total',                         
                                    DATE(token.`created_at`) AS 'day',
                                    token.`location_id`
                                    "))
                            ->join('locations', 'locations.id', '=', 'token.location_id')
                            ->join('user', 'user.id', '=', 'token.user_id')
                            ->whereIn('token.location_id', $data->locations)
                            ->where('token.no_show', 1)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->groupByRaw('DATE(token.`created_at`),token.`location_id`,`location_name`,`officer`')
                            ->orderByRaw('location_name', 'officer', 'day')
                            ->get();

                        break;
                    case '9':
                        $data->data = Token::whereIn('location_id', $data->locations)
                            ->whereBetween('token.created_at', [$start, $end])
                            ->with(['location' => function ($q) {
                                $q->orderBy('name');
                            }])
                            ->orderBy('created_at')
                            ->get();

                        break;
                    case '10':
                        $data->data = DB::select("
                        SELECT 
                           realToken.user_id AS uid,
                           (SELECT name FROM locations WHERE id= realToken.location_id) as location,
                           (SELECT CONCAT_WS(' ', firstname, lastname) FROM user WHERE id= realToken.user_id) as officer,
                         (
                           SELECT COUNT(id) 
                           FROM token 
                           WHERE 
                               user_id=realToken.user_id
                               AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                               AND (location_id in (" . implode(',', $data->locations) . "))
                         ) AS total,
                         
                         (
                           SELECT COUNT(id) 
                           FROM token 
                           WHERE 
                               status = 2 
                               AND user_id=realToken.user_id
                               AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                               AND (location_id in (" . implode(',', $data->locations) . "))
                         ) AS stoped,
                         (
                           SELECT COUNT(id) 
                           FROM token 
                           WHERE 
                               status = 1 
                               AND user_id=realToken.user_id
                               AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                               AND (location_id in (" . implode(',', $data->locations) . "))
                         ) AS success,
                         (
                           SELECT COUNT(id)
                           FROM token 
                           WHERE 
                               status = 0 
                               AND user_id=realToken.user_id
                               AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                               AND (location_id in (" . implode(',', $data->locations) . "))
                         ) AS pending
                         FROM 
                           token AS realToken   
                           where realToken.location_id in (" . implode(',', $data->locations) . ")        
                         GROUP BY user_id
                         ORDER BY location, officer
                       ");

                        break;
                    default:
                        # code...
                        break;
                }

                $data->home = false;

                $reports = \App\Core\Data::getReportList();
                $ids = array_column($reports, 'id');
                $found_key = array_search($data->report, $ids);

                $name = $reports[$found_key]['title'];
                $view = $reports[$found_key]['reportview'];

                $mail_to = explode(',', $value->report->email_to);
                
                $pdf = PDF::loadView($view, array('data' => $data->data, 'master' => $data));
                foreach ($mail_to as $_mail_to) {                    
                    $message = "You're scheduled report: $name has been generated. ";
                    $message .= "Please see attachement";
                    Mail::to($_mail_to)->send(new ScheduledReportNotification($message, $name, $pdf->output()));                    
                }
                ScheduledReportsTask::where('id', $value->id)->update(['executed_time' => Carbon::now(), 'success' => true, 'notified' => $value->report->email_to]);
            } catch (\Throwable $th) {
                ScheduledReportsTask::where('id', $value->id)->update(['executed_time' => Carbon::now(), 'success' => false, 'notified' => '', 'response'=> $th->getMessage()]);
                throw $th;
            }
        }
    }

    public function sendWhatsAppNotification($token, $position)
    {
        // // Instantiate the WhatsAppCloudApi super class.

        $whatsapp_cloud_api = new WhatsAppCloudApi([]);


        $phone = $this->sanitizePhoneNumber($token->mobile);

        $component_header = [[
            'type' => 'text',
            'text' => $token->location->name,
        ],];

        $component_body = [
            [
                'type' => 'text',
                'text' => $token->token_no,
            ],
            [
                'type' => 'text',
                'text' => $token->department->name,
            ],
            [
                'type' => 'text',
                'text' => $token->counter->name,
            ],
            [
                'type' => 'text',
                'text' => $token->officer->name,
            ],
            [
                'type' => 'text',
                'text' => $position,
            ],
        ];

        $component_buttons = [];

        $components = new Component($component_header, $component_body, $component_buttons);

        // $response = $whatsapp_cloud_api->sendTemplate($phone, $message);
        $response = $whatsapp_cloud_api->sendTemplate($phone, 'smartq_position_notification', 'en', $components);
        Token::where('id', $token->id)->update(['sms_status' => 1]);
        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // die();
        return $response;
    }
}
