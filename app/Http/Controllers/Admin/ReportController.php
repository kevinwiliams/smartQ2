<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
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
                        ->orderByRaw('location_name', 'year','week')
                        ->get();
                    break;
                case '4':
                        $data->data = DB::table("token")
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
                            ->orderByRaw('location_name', 'year','month')
                            ->get();
                        break;
                default:
                    # code...
                    break;
            }
        }

        $locations = Location::get();
        return view('pages.reports.index', compact('locations', 'data'));
    }
}
