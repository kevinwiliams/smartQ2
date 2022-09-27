<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Reports\ScheduledReportsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\ScheduledReport;
use App\Models\ScheduledReportsTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ScheduledReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScheduledReportsDataTable $dataTable)
    {
        if (!auth()->user()->can('view scheduled reports')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));

        // $info = ScheduledReport::first();
        // echo '<pre>';
        // print_r(session('app.timezone'));
        // echo '</pre>';
        // die();
        $company_id = auth()->user()->location->company_id;
        $locations = Location::where('company_id', $company_id)->get();

        return $dataTable->with('report_user_id', auth()->user()->id)->render('pages.scheduledreports.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create scheduled report')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'report_id'      => 'required',
            'schedule_type'      => 'required',
            'start_date'      => 'required',
            'date_range'      => 'required',
            'location_id'      => 'required',
            'notify'      => 'required',
        ])
            ->setAttributeNames(array(
                'report_id' => trans('app.report'),
                'name' => trans('app.name'),
                'schedule_type' => trans('app.schedule_type'),
                'start_date' => trans('app.start_date'),
                'date_range' => trans('app.date_range'),
                'location_id' => trans('app.location_id'),
                'notify' => trans('app.notify'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {


            $savedata['name'] = $request->name;
            $savedata['active'] = 1;
            $savedata['report_id'] = $request->report_id;
            $savedata['schedule_type'] = $request->schedule_type;
            $savedata['start_date'] = $request->start_date;
            $savedata['user_id'] = auth()->user()->id;

            ///Parse notification email json
            $notifyarray = json_decode($request->notify, true);
            $plucked = array_column($notifyarray, 'value');
            $savedata['email_to'] = implode(',', $plucked);

            switch ($request->schedule_type) {
                case 'daily':
                    $jsoninfo["recurs"] = $request->daily_recurs;
                    $jsoninfo['end_date'] = $request->daily_end_date;
                    break;
                case 'weekly':
                    $jsoninfo["recurs"] = $request->weekly_recurs;
                    $jsoninfo["weekdays"] = $request->weekly_dayname;
                    $jsoninfo['end_date'] = $request->weekly_end_date;
                    break;
                case 'monthly':
                    $jsoninfo["months"] = $request->monthly_months;
                    $jsoninfo["months_on"] = $request->monthly_months_on;
                    $jsoninfo["months_days"] = $request->monthly_days;
                    $jsoninfo["ordinal"] = $request->monthly_ordinal;
                    $jsoninfo["weekday"] = $request->monthly_weekday;
                    $jsoninfo['end_date'] = $request->monthly_end_date;
                    break;
            }

            $jsoninfo["date_range"] = $request->date_range;
            $jsoninfo["locations"] = $request->location_id;
            $savedata['schedule_info'] = json_encode($jsoninfo);



            //Generate run time array & fail if empty
            $taskArray = array();
            $_start = Carbon::createFromFormat('Y-m-d h:i A', $request->start_date);
            $_startCopy = clone $_start;
            // echo '<pre>';
            // print_r($_startCopy->toDateTimeString());
            // echo '</pre>';
            switch ($request->schedule_type) {
                case 'daily':
                    $_end = Carbon::createFromFormat('Y-m-d', $request->daily_end_date);

                    while ($_start <= $_end) {
                        $taskArray[] = $_start->toDateTimeString();
                        $_start = $_start->addDays($request->daily_recurs);
                    }

                    break;
                case 'weekly':
                    $_end = Carbon::createFromFormat('Y-m-d', $request->weekly_end_date);

                    //Get weeks
                    $weekstart = clone $_start;
                    $weekstart->startOfWeek();
                    $mins = $_startCopy->diffInMinutes($_start->startOfDay());
                    // echo '<pre>';
                    // print_r($_start->toDateTimeString());
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r($_start->startOfDay()->toDateTimeString());
                    // echo '</pre>';
                    // echo '<pre>';
                    // print_r($mins);
                    // echo '</pre>';                    
                    // die();
                    while ($weekstart <= $_end) {
                        //Iterate days in that week and add if they match

                        $_sow = clone $weekstart;
                        $_sow->startOfWeek();
                        $_eow = clone $weekstart;
                        $_eow->endOfWeek();

                        while ($_sow <= $_eow) {
                            if (in_array($_sow->englishDayOfWeek, $request->weekly_dayname)) {
                                if ($_sow >= $_start && $_sow <= $_end) {
                                    $tmp = clone $_sow;
                                    $tmp->addMinutes($mins);
                                    $taskArray[] = $tmp->toDateTimeString();
                                }
                            }

                            $_sow = $_sow->addDay();
                        }

                        $weekstart = $weekstart->addWeeks($request->weekly_recurs);
                    }

                    break;
                case 'monthly':
                    $_end = Carbon::createFromFormat('Y-m-d', $request->monthly_end_date);
                    $mins = $_startCopy->diffInMinutes($_start->startOfDay());
                    if ($request->monthly_months_on == "days") {
                        while ($_start <= $_end) {
                            if (in_array($_start->monthName, $request->monthly_months)) {
                                if (in_array($_start->day, $request->monthly_days)) {
                                    $taskArray[] = $_start->toDateTimeString();
                                }
                            }

                            $_start = $_start->addday();
                        }
                    } else {

                        for ($i = $_start->year; $i <= $_end->year; $i++) {
                            foreach ($request->monthly_months as $month) {
                                foreach ($request->monthly_ordinal as $ordinal) {
                                    foreach ($request->monthly_weekday as $weekday) {
                                        $newdate =  Carbon::parse($ordinal . ' ' . $weekday . ' of ' . $month . ' ' . $i)->addMinutes($mins);
                                        if ($newdate >= $_start && $newdate <= $_end) {
                                            $taskArray[] = $newdate->toDateTimeString();
                                        }
                                    }
                                }
                            }
                        }
                    }
                    break;
                default:
                    $taskArray[] =  $_start->toDateTimeString();
                    break;
            }

            // echo '<pre>';
            // print_r($taskArray);
            // echo '</pre>';
            // die();

            if (count($taskArray) == 0) {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data, 400);
            }

            // echo '<pre>';
            // print_r($taskArray);
            // echo '</pre>';
            // die();

            ///Generate: schedule report
            $schedule = ScheduledReport::create($savedata);

            if ($schedule) {
                $taskdata = array();
                foreach ($taskArray as $value) {
                    $taskdata[] = ["schedule_id" => $schedule->id, "run_time" => $value];
                }

                ScheduledReportsTask::insert($taskdata);

                $data['status'] = true;
                $data['data'] = $schedule;
                $data['message'] = trans('app.save_successfully');
                return response()->json($data);
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data, 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScheduledReports  $scheduledReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('view scheduled reports')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));

        $data = ScheduledReport::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScheduledReports  $scheduledReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduledReport $scheduledReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScheduledReports  $scheduledReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('update scheduled report')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'report_id'      => 'required',
            'schedule_type'      => 'required',
            'start_date'      => 'required',
            'date_range'      => 'required',
            'location_id'      => 'required',
            'notify'      => 'required',
        ])
            ->setAttributeNames(array(
                'report_id' => trans('app.report'),
                'name' => trans('app.name'),
                'schedule_type' => trans('app.schedule_type'),
                'start_date' => trans('app.start_date'),
                'date_range' => trans('app.date_range'),
                'location_id' => trans('app.location_id'),
                'notify' => trans('app.notify'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {


            $savedata['name'] = $request->name;
            $savedata['active'] = ($request->has('active')) ? 1 : 0;
            $savedata['report_id'] = $request->report_id;
            $savedata['schedule_type'] = $request->schedule_type;
            $savedata['start_date'] = $request->start_date;
            // $savedata['user_id'] = auth()->user()->id;

            ///Parse notification email json
            $notifyarray = json_decode($request->notify, true);
            $plucked = array_column($notifyarray, 'value');
            $savedata['email_to'] = implode(',', $plucked);

            switch ($request->schedule_type) {
                case 'daily':
                    $jsoninfo["recurs"] = $request->daily_recurs;
                    $jsoninfo['end_date'] = $request->daily_end_date;
                    break;
                case 'weekly':
                    $jsoninfo["recurs"] = $request->weekly_recurs;
                    $jsoninfo["weekdays"] = $request->weekly_dayname;
                    $jsoninfo['end_date'] = $request->weekly_end_date;
                    break;
                case 'monthly':
                    $jsoninfo["months"] = $request->monthly_months;
                    $jsoninfo["months_on"] = $request->monthly_months_on;
                    $jsoninfo["months_days"] = $request->monthly_days;
                    $jsoninfo["ordinal"] = $request->monthly_ordinal;
                    $jsoninfo["weekday"] = $request->monthly_weekday;
                    $jsoninfo['end_date'] = $request->monthly_end_date;
                    break;
            }

            $jsoninfo["date_range"] = $request->date_range;
            $jsoninfo["locations"] = $request->location_id;
            $savedata['schedule_info'] = json_encode($jsoninfo);

            //Generate run time array & fail if empty
            $taskArray = array();
            $_start = Carbon::createFromFormat('Y-m-d h:i A', $request->start_date);
            $_startCopy = clone $_start;
          
            switch ($request->schedule_type) {
                case 'daily':
                    $_end = Carbon::createFromFormat('Y-m-d', $request->daily_end_date);

                    while ($_start <= $_end) {
                        $taskArray[] = $_start->toDateTimeString();
                        $_start = $_start->addDays($request->daily_recurs);
                    }

                    break;
                case 'weekly':
                    $_end = Carbon::createFromFormat('Y-m-d', $request->weekly_end_date);

                    //Get weeks
                    $weekstart = clone $_start;
                    $weekstart->startOfWeek();
                    $mins = $_startCopy->diffInMinutes($_start->startOfDay());
                    
                    while ($weekstart <= $_end) {
                        //Iterate days in that week and add if they match

                        $_sow = clone $weekstart;
                        $_sow->startOfWeek();
                        $_eow = clone $weekstart;
                        $_eow->endOfWeek();

                        while ($_sow <= $_eow) {
                            if (in_array($_sow->englishDayOfWeek, $request->weekly_dayname)) {
                                if ($_sow >= $_start && $_sow <= $_end) {
                                    $tmp = clone $_sow;
                                    $tmp->addMinutes($mins);
                                    $taskArray[] = $tmp->toDateTimeString();
                                }
                            }

                            $_sow = $_sow->addDay();
                        }

                        $weekstart = $weekstart->addWeeks($request->weekly_recurs);
                    }

                    break;
                case 'monthly':
                    $_end = Carbon::createFromFormat('Y-m-d', $request->monthly_end_date);
                    $mins = $_startCopy->diffInMinutes($_start->startOfDay());
                    if ($request->monthly_months_on == "days") {
                        while ($_start <= $_end) {
                            if (in_array($_start->monthName, $request->monthly_months)) {
                                if (in_array($_start->day, $request->monthly_days)) {
                                    $taskArray[] = $_start->toDateTimeString();
                                }
                            }

                            $_start = $_start->addday();
                        }
                    } else {

                        for ($i = $_start->year; $i <= $_end->year; $i++) {
                            foreach ($request->monthly_months as $month) {
                                foreach ($request->monthly_ordinal as $ordinal) {
                                    foreach ($request->monthly_weekday as $weekday) {
                                        $newdate =  Carbon::parse($ordinal . ' ' . $weekday . ' of ' . $month . ' ' . $i)->addMinutes($mins);
                                        if ($newdate >= $_start && $newdate <= $_end) {
                                            $taskArray[] = $newdate->toDateTimeString();
                                        }
                                    }
                                }
                            }
                        }
                    }
                    break;
                default:
                    $taskArray[] =  $_start->toDateTimeString();
                    break;
            }

            // echo '<pre>';
            // print_r($taskArray);
            // echo '</pre>';
            // die();

            if (count($taskArray) == 0) {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data, 400);
            }

            // echo '<pre>';
            // print_r($taskArray);
            // echo '</pre>';
            // foreach ($taskArray as $value) {
            //     echo '<pre>';
            //     print_r($value);
            //     echo '</pre>';
            //     //filter where schedule date is less than now
            //     $tmp = Carbon::parse($value);
            //     $now = Carbon::now();
            //     if ($tmp >= $now) {
            //         echo '<pre>';
            //         print_r($value);
            //         echo '</pre>';
            //     }
            // }
            // die();

            ///Generate: schedule report
            $schedule = ScheduledReport::where('id', $id)->update($savedata);

            if ($schedule) {
                $taskdata = array();
                $now = Carbon::now(session('app.timezone'));
                ScheduledReportsTask::where('schedule_id', $id)->whereRaw('run_time >= \'' . $now. '\'')->delete();
                foreach ($taskArray as $value) {
                    //filter where schedule date is less than now
                    $tmp = Carbon::parse($value);
                    if ($tmp >= $now) {
                        $taskdata[] = ["schedule_id" => $id, "run_time" => $value];
                    }
                }

                ScheduledReportsTask::insert($taskdata);

                $data['status'] = true;
                $data['data'] = $schedule;
                $data['message'] = trans('app.save_successfully');
                return response()->json($data);
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data, 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScheduledReports  $scheduledReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            ScheduledReportsTask::where('schedule_id', $id)->delete();
            ScheduledReport::where('id', $id)->delete();
            $data['status'] = true;
            $data['message'] = trans('app.report_deleted_successfully');
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['exception'] = trans('app.please_try_again');
            $data['errorObj'] = $th;
        }

        return response()->json($data);
    }


    public function history($id)
    {
        // echo $id;
        // die();
        @date_default_timezone_set(session('app.timezone'));
        // try {
        $info = ScheduledReportsTask::where('schedule_id', $id)->whereRaw('run_time <= \'' . Carbon::now(session('app.timezone')) . '\'')->get();

        // echo '<pre>';
        // print_r($info);
        // echo '</pre>';
        // die();
        $data['data'] = $info;
        $data['status'] = true;
        $data['message'] = trans('app.history_retrieved_successfully');
        // } catch (\Throwable $th) {
        //     $data['status'] = false;
        //     $data['exception'] = trans('app.please_try_again');
        //     $data['errorObj'] = $th;
        // }

        return response()->json($data);
    }

    public function schedule($id)
    {
        // echo $id;
        // die();
        @date_default_timezone_set(session('app.timezone'));
        // try {
        $info = ScheduledReportsTask::where('schedule_id', $id)->whereRaw('run_time >= \'' . Carbon::now(session('app.timezone')) . '\'')->get();

        // echo '<pre>';
        // print_r($info);
        // echo '</pre>';
        // die();
        $data['data'] = $info;
        $data['status'] = true;
        $data['message'] = trans('app.history_retrieved_successfully');
        // } catch (\Throwable $th) {
        //     $data['status'] = false;
        //     $data['exception'] = trans('app.please_try_again');
        //     $data['errorObj'] = $th;
        // }

        return response()->json($data);
    }
}
