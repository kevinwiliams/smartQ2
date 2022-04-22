<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Mail\TokenNotification;
use App\Models\DepartmentStats;
use Illuminate\Http\Request;
use App\Models\Display;
use App\Models\DisplaySetting;
use App\Models\LocationStats;
use Carbon\Carbon;
use App\Models\SmsSetting;
use App\Models\SmsHistory;
use App\Models\Token;
use App\Models\User;
use App\Models\UserStats;
use DB, Response, File, Validator;
use Kutia\Larafirebase\Facades\Larafirebase;
use Mail;

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
        $setting   = DisplaySetting::first();
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
                "t.created_at AS date"
            )
            ->leftJoin("department AS d", "d.id", "=", "t.department_id")
            ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
            ->leftJoin("user AS o", "o.id", "=", "t.user_id")
            ->where("t.status", "0")
            ->orderBy('t.is_vip', 'DESC')
            ->orderBy('t.id', 'ASC')
            ->offset($setting->alert_position)
            ->limit(1)
            ->get();

        if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
            // send sms
            $data['status'] = true;
            $data['result'] = $tokenInfo;
            $this->sendSMS($tokenInfo, $setting->alert_position);
        } else {
            //Send email
            $data['status'] = false;
            $data['result'] = $tokenInfo;
            // send Email 
            $this->sendEmail($tokenInfo);
        }

        $this->sendPushNotification($tokenInfo);

        return Response::json($data);
    }

    //counter wise 
    public function display3()
    {
        $setting = DisplaySetting::first();
        $counters = DB::table('counter')
            ->where('status', 1)
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
                    "t.created_at"
                )
                ->leftJoin("department AS d", "d.id", "=", "t.department_id")
                ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
                ->leftJoin("user AS o", "o.id", "=", "t.user_id")
                ->where("t.counter_id", $counter->id)
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
                );
            }
        }

        foreach ($allToken as $counter => $tokenInfo) {
            if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                $data['status'] = true;
                $data['result'][] = $tokenInfo;
                // send sms 
                $this->sendSMS($tokenInfo, $setting->alert_position);
            } else {
                $data['status'] = false;
                $data['result'][] = $tokenInfo;
                // send Email 
                $this->sendEmail($tokenInfo);
            }

            $this->sendPushNotification($tokenInfo);
        }

        return Response::json($data);
    }

    //department wise 
    public function display4()
    {
        $setting = DisplaySetting::first();
        $departments = DB::table('department')
            ->where('status', 1)
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
                    "t.created_at"
                )
                ->leftJoin("department AS d", "d.id", "=", "t.department_id")
                ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
                ->leftJoin("user AS o", "o.id", "=", "t.user_id")
                ->where("t.department_id", $department->id)
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
                );
            }
        }

        foreach ($allToken as $counter => $tokenInfo) {
            if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                $data['status'] = true;
                $data['result'][] = $tokenInfo;
                // send sms 
                $this->sendSMS($tokenInfo, $setting->alert_position);
            } else {
                $data['status'] = true;
                $data['result'][] = $tokenInfo;
                // send Email 
                $this->sendEmail($tokenInfo);
            }
            $this->sendPushNotification($tokenInfo);
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
}
