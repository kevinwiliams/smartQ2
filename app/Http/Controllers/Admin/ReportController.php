<?php

namespace App\Http\Controllers\Admin;

use App\Core\Util;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Location;
use App\Models\ReasonForVisit;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (!auth()->user()->can('view report')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $data = (object)array();
        $data->report = (request()->has('report')) ? request('report') : '';
        $data->location_id = (request()->has('location_id')) ? request('location_id') : '';
        $data->daterange = (request()->has('daterange')) ? request('daterange') : '';
        $data->data = null;
        $data->graph = false;
        if (request()->has('report') && request()->has('location_id') && request()->has('daterange')) {
            $daterange = explode("-", request('daterange'));
            $start =  Carbon::createFromTimestamp(strtotime($daterange[0]))->startOfDay()->format("Y-m-d H:i:s");
            $end =   Carbon::createFromTimestamp(strtotime($daterange[1]))->endOfDay()->format("Y-m-d H:i:s");
            switch (request('report')) {
                case '1':
                    $info = DB::table("token")
                        ->select(DB::raw("
                    locations.name AS location_name,
                    COUNT(token.`created_at`) AS total, 
                    HOUR(token.`created_at`) AS hour, 
                    DATE(token.`created_at`) AS day,
                    `location_id`
                    "))
                        ->join('locations', 'locations.id', '=', 'token.location_id')
                        ->whereIn('location_id', explode(",", request('location_id')))
                        ->whereBetween('token.created_at', ["'$start'", "'$end'"])
                        ->groupByRaw('DATE(token.`created_at`),HOUR(token.`created_at`),`location_id`,`location_name`')
                        ->orderByRaw('location_name', 'day', 'hour')
                        ->get();


                    $data->data = $info;

                    $startDateUnix = Carbon::parse($start)->startOfDay();
                    $endDateUnix = Carbon::parse($end)->endOfDay();
                    $currentDateUnix = $startDateUnix;

                    $monthNumbers = array();
                    while ($startDateUnix <= $endDateUnix) {
                        array_push($monthNumbers, array('hour' => $startDateUnix->hour, 'day' => $startDateUnix->format('Y-m-d'), 'year' => $startDateUnix->year));
                        $startDateUnix = $startDateUnix->addHour();
                    }

                    $seriesdata = array();

                    $locations = array_unique($info->pluck('location_name')->toArray());

                    foreach ($locations as $location_name) {
                        $datarow = array();
                        foreach ($monthNumbers as $_month) {

                            $inforow =  $info->where('location_name', $location_name)->where('day', $_month['day'])->where('hour', $_month['hour'])->first();
                            array_push($datarow, ($inforow) ? $inforow->total : 0);
                        }
                        array_push($seriesdata, array('name' => $location_name, 'data' => $datarow));
                    }

                    $data->graph = true;
                    $data->seriesdata = $seriesdata;

                    $categories = array();

                    foreach ($monthNumbers as $_month) {
                        array_push($categories, 'Hour: '.$_month['hour'] . ' - ' .$_month['day']);
                    }
                    $data->categories = $categories;
                    break;
                case '2':
                    $info = DB::table("token")
                        ->select(DB::raw("
                        locations.name AS location_name',
                        COUNT(token.`created_at`) AS 'total',                         
                        DATE(token.`created_at`) AS 'day',
                        DAY(token.`created_at`) AS 'daynumber',
                        `location_id`
                        "))
                        ->join('locations', 'locations.id', '=', 'token.location_id')
                        ->whereIn('location_id', explode(",", request('location_id')))
                        ->whereBetween('token.created_at', ["'$start'", "'$end'"])
                        ->groupByRaw('DATE(token.`created_at`),`location_id`,`location_name`')
                        ->orderByRaw('location_name', 'day')
                        ->get();

                    $data->data = $info;

                    $startDateUnix = Carbon::parse($start)->startOfDay();
                    $endDateUnix = Carbon::parse($end)->endOfDay();
                    $currentDateUnix = $startDateUnix;

                    $monthNumbers = array();
                    while ($startDateUnix <= $endDateUnix) {
                        array_push($monthNumbers, array('daynumber' => $startDateUnix->day, 'dayname' => $startDateUnix->dayName, 'day' => $startDateUnix->format('Y-m-d'), 'year' => $startDateUnix->year));
                        $startDateUnix = $startDateUnix->addDays(1);
                    }

                    $seriesdata = array();

                    $locations = array_unique($info->pluck('location_name')->toArray());

                    foreach ($locations as $location_name) {
                        $datarow = array();
                        foreach ($monthNumbers as $_month) {

                            $inforow =  $info->where('location_name', $location_name)->where('day', $_month['day'])->first();
                            array_push($datarow, ($inforow) ? $inforow->total : 0);
                        }
                        array_push($seriesdata, array('name' => $location_name, 'data' => $datarow));
                    }

                    $data->graph = true;
                    $data->seriesdata = $seriesdata;

                    $categories = array();

                    foreach ($monthNumbers as $_month) {
                        array_push($categories, $_month['day']);
                    }
                    $data->categories = $categories;
                    break;
                case '3':
                    $info = DB::table("token")
                        ->select(DB::raw("
                            locations.name AS 'location_name',
                            COUNT(token.`created_at`) AS 'total',                         
                            WEEK(token.`created_at`) AS 'week',
                            YEAR(token.`created_at`) AS 'year',
                            `location_id`
                            "))
                        ->join('locations', 'locations.id', '=', 'token.location_id')
                        ->whereIn('location_id', explode(",", request('location_id')))
                        ->whereBetween('token.created_at', ["'$start'", "'$end'"])
                        ->groupByRaw('YEAR(token.`created_at`),WEEK(token.`created_at`),`location_id`,`location_name`')
                        ->orderByRaw('location_name', 'year', 'week')
                        ->get();
                    $data->data = $info;

                    $startDateUnix = Carbon::parse($start)->startOfWeek();
                    $endDateUnix = Carbon::parse($end)->endOfWeek();
                    // $endYear = date('Y', $startDateUnix);
                    // $endMonth =  date('m', $startDateUnix);

                    $currentDateUnix = $startDateUnix;

                    $monthNumbers = array();
                    while ($startDateUnix <= $endDateUnix) {
                        // $weekNumbers[] = date('W', $currentDateUnix) . ' - ' . date('Y', $currentDateUnix);
                        array_push($monthNumbers, array('week' => $startDateUnix->week, 'weekname' => $startDateUnix->week, 'year' => $startDateUnix->year));
                        $startDateUnix = $startDateUnix->addWeek(1);
                    }

                    $seriesdata = array();

                    $locations = array_unique($info->pluck('location_name')->toArray());

                    foreach ($locations as $location_name) {
                        $datarow = array();
                        foreach ($monthNumbers as $_month) {

                            $inforow =  $info->where('year', $_month['year'])->where('location_name', $location_name)->where('week', $_month['week'])->first();
                            array_push($datarow, ($inforow) ? $inforow->total : 0);
                        }
                        array_push($seriesdata, array('name' => $location_name, 'data' => $datarow));
                    }
                    $data->graph = true;
                    $data->seriesdata = $seriesdata;

                    $categories = array();

                    foreach ($monthNumbers as $_month) {
                        array_push($categories, "W-" . $_month['week'] . ' ' . $_month['year']);
                    }
                    $data->categories = $categories;

                    // echo '<pre>';
                    // print_r($data->data);
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // die();

                    break;
                case '4':

                    $info = DB::table("token")
                        ->select(DB::raw("
                                locations.name AS location_name,
                                COUNT(token.`created_at`) AS total,                         
                                MONTH(token.`created_at`) AS month,
                                YEAR(token.`created_at`) AS year,
                                `location_id`
                                "))
                        ->join('locations', 'locations.id', '=', 'token.location_id')
                        ->whereIn('location_id', explode(",", request('location_id')))
                        // ->whereBetween('token.created_at', ["'$start'", "'$end'"])
                        ->where('token.created_at','>=', "'$start'")
                        ->where('token.created_at','<=', "'$end'")                        
                        ->groupByRaw('YEAR(token.`created_at`),MONTH(token.`created_at`),`location_id`,`location_name`')
                        ->orderByRaw('location_name', 'year', 'month')
                        ->get();
                    $data->data = $info;
                    $startDateUnix = Carbon::parse($start)->firstOfMonth();
                    $endDateUnix = Carbon::parse($end)->lastOfMonth();
                    // $endYear = date('Y', $startDateUnix);
                    // $endMonth =  date('m', $startDateUnix);

                    $currentDateUnix = $startDateUnix;

                    $monthNumbers = array();
                    while ($startDateUnix <= $endDateUnix) {
                        // $weekNumbers[] = date('W', $currentDateUnix) . ' - ' . date('Y', $currentDateUnix);
                        array_push($monthNumbers, array('month' => $startDateUnix->month, 'monthname' => $startDateUnix->monthName, 'year' => $startDateUnix->year));
                        $startDateUnix = $startDateUnix->addMonth(1);
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

                    // echo '<pre>';
                    // print_r($data->data);
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // die();
                    break;
                case '5':
                    // date_default_timezone_set(session('app.timezone'));
                    $tokens = Token::has('status')
                        ->whereIn('location_id', explode(",", request('location_id')))
                        ->whereBetween('created_at', ["'$start'", "'$end'"])
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

                            if ($_locationtoken->getWaitTimeMinutes() != null) {
                                $waittotal += $_locationtoken->getWaitTimeMinutes();
                                if ($mintime < $_locationtoken->getWaitTimeMinutes() || $waitcounter == 0)
                                    $mintime = $_locationtoken->getWaitTimeMinutes();

                                if ($maxtime > $_locationtoken->getWaitTimeMinutes() || $waitcounter == 0)
                                    $maxtime = $_locationtoken->getWaitTimeMinutes();

                                $waitcounter++;
                            }

                            // if ($_locationtoken->service_time != null) {
                            //     $servicetotal += $_locationtoken->service_time;
                            //     $servicecounter++;
                            // }
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

                    // echo '<pre>';
                    // print_r($data->data == null);
                    // echo '</pre>';
                    // die();

                    break;
                case '6':
                    // date_default_timezone_set(session('app.timezone'));
                    $tokens = Token::has('status')
                        ->whereIn('location_id', explode(",", request('location_id')))
                        ->whereBetween('created_at', ["'$start'", "'$end'"])
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

                            if ($_locationtoken->getServiceTimeMinutes() != null) {
                                $servicetotal += $_locationtoken->getServiceTimeMinutes();
                                if ($mintime < $_locationtoken->getServiceTimeMinutes() || $servicecounter == 0)
                                    $mintime = $_locationtoken->getServiceTimeMinutes();

                                if ($maxtime > $_locationtoken->getServiceTimeMinutes() || $servicecounter == 0)
                                    $maxtime = $_locationtoken->getServiceTimeMinutes();

                                $servicecounter++;
                            }

                            // if ($_locationtoken->service_time != null) {
                            //     $servicetotal += $_locationtoken->service_time;
                            //     $servicecounter++;
                            // }
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
                        ->whereIn('token.location_id', explode(",", request('location_id')))
                        ->whereNotNull('started_at')
                        ->where('token.status', 2)
                        ->whereBetween('token.created_at', ["'$start'", "'$end'"])
                        ->groupByRaw('DATE(token.`created_at`),token.`location_id`,`location_name`,`officer`')
                        ->orderByRaw('location_name', 'officer', 'day')
                        ->get();


                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // die();

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
                        ->whereIn('token.location_id', explode(",", request('location_id')))
                        ->where('token.no_show', 1)
                        ->whereBetween('token.created_at', ["'$start'", "'$end'"])
                        ->groupByRaw('DATE(token.`created_at`),token.`location_id`,`location_name`,`officer`')
                        ->orderByRaw('location_name', 'officer', 'day')
                        ->get();


                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // die();

                    break;
                case '9':
                    $data->data = Token::whereIn('location_id', explode(",", request('location_id')))
                        ->whereBetween('token.created_at', ["'$start'", "'$end'"])
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
                           AND (location_id in (" . request('location_id') . "))
                     ) AS total,
                     
                     (
                       SELECT COUNT(id) 
                       FROM token 
                       WHERE 
                           status = 2 
                           AND user_id=realToken.user_id
                           AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                           AND (location_id in (" . request('location_id') . "))
                     ) AS stoped,
                     (
                       SELECT COUNT(id) 
                       FROM token 
                       WHERE 
                           status = 1 
                           AND user_id=realToken.user_id
                           AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                           AND (location_id in (" . request('location_id') . "))
                     ) AS success,
                     (
                       SELECT COUNT(id)
                       FROM token 
                       WHERE 
                           status = 0 
                           AND user_id=realToken.user_id
                           AND (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                           AND (location_id in (" . request('location_id') . "))
                     ) AS pending
                     FROM 
                       token AS realToken   
                       where realToken.location_id in (" . request('location_id') . ")        
                     GROUP BY user_id
                     ORDER BY location, officer
                   ");


                    break;
                case '11':

                    //     $user_info = DB::table('usermetas')
                    //  ->select('browser', DB::raw('count(*) as total'))
                    //  ->groupBy('browser')
                    //  ->get();

                    $deptids = DB::table("department")
                        ->whereIn('location_id', explode(",", request('location_id')))
                        ->get()->pluck('id')->toArray();

                    $dbreasons = ReasonForVisit::whereIn('department_id', $deptids)->orderBy('reason')->pluck('reason')->toArray();

                    $infoarray = DB::select("
                        SELECT reason_for_visit, COUNT(*) AS count
                        FROM token
                        WHERE (DATE(created_at) BETWEEN '" . $start . "' AND '" . $end . "')
                        AND (location_id in (" . request('location_id') . "))
                        GROUP BY reason_for_visit
                        ORDER BY count DESC
                   ");

                    $total = 0;
                    foreach ($infoarray as $value) {
                        $total += $value->count;
                        if (empty($value->reason_for_visit))
                            $value->reason_for_visit = "None Stated";
                    }

                    foreach ($infoarray as $value) {
                        if ($total > 0)
                            $value->percentage = ($value->count / $total) * 100;
                        else
                            $value->percentage = 0;
                    }

                    $usedreasons =  array_column($infoarray, 'reason_for_visit');
                    $unusedreasons = array_diff($dbreasons, $usedreasons);

                    foreach ($unusedreasons as $value) {
                        $objarray = (object)array();
                        $objarray->reason_for_visit = $value;
                        $objarray->count = 0;
                        $objarray->percentage = 0;
                        array_push($infoarray, $objarray);
                    }
                    // echo '<pre>';
                    // print_r($infoarray);
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r($dbreasons);
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r(array_diff($dbreasons, $usedreasons));
                    // echo '</pre>';

                    // die();

                    $data->data = $infoarray;
                    // echo '<pre>';
                    // print_r($infoarray);
                    // echo '</pre>';
                    // die();
                    break;
                default:
                    # code...
                    break;
            }
            $data->home = false;
        } else {
            $data->home = true;
        }


        $company_id = auth()->user()->location->company_id;
        $locations = Location::where('company_id', $company_id)->get();
        return view('pages.reports.index', compact('locations', 'data'));
    }
}
