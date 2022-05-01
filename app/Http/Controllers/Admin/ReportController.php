<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = (object)array();
        $data->report = (request()->has('report')) ? request('report') : '';
        $data->location_id = (request()->has('location_id')) ? request('location_id') : '';
        $data->daterange = (request()->has('daterange')) ? request('daterange') : '';
        $data->data = null;
        $data->graph = false;
        if (request()->has('report') && request()->has('location_id') && request()->has('daterange')) {
            $daterange = explode("-", request('daterange'));
            $start = Carbon::createFromTimestamp(strtotime($daterange[0]));
            $end = Carbon::createFromTimestamp(strtotime($daterange[1]));
            switch (request('report')) {
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
                        ->whereIn('location_id', explode(",", request('location_id')))
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
                        ->whereIn('location_id', explode(",", request('location_id')))
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
                        ->whereIn('location_id', explode(",", request('location_id')))
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
                        ->whereIn('location_id', explode(",", request('location_id')))
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

                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // die();
                    break;
                case '9':
                    $data->data = Token::whereIn('location_id', explode(",", request('location_id')))
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
                default:
                    # code...
                    break;
            }
        }

        $company_id = auth()->user()->location->company_id;
        $locations = Location::where('company_id', $company_id)->get();
        return view('pages.reports.index', compact('locations', 'data'));
    }
}
