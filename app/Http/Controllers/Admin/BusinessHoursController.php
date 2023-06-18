<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessHours;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Redirect;

class BusinessHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('view business hours')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $hours = BusinessHours::where('location_id', $id)->get();
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)
            ->withCount('visitorslastweek')
            ->first();
        // $visitor_summary = $this->chart_visitor_summary($id);
        // $biannual = $this->chart_biannual($id);



        return view('pages.location.businesshours.list', compact('location', 'departments', 'counters', 'officers', 'hours'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessHours $businessHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    if (!auth()->user()->can('edit company')) {
        return Redirect::to("/")->withFail(trans('app.no_permissions'));
    }

    @date_default_timezone_set(session('app.timezone'));

    $days = [
        1 => ['is_open' => $request->is_open_1, 'start_time' => $request->start_time_1, 'end_time' => $request->end_time_1],
        2 => ['is_open' => $request->is_open_2, 'start_time' => $request->start_time_2, 'end_time' => $request->end_time_2],
        3 => ['is_open' => $request->is_open_3, 'start_time' => $request->start_time_3, 'end_time' => $request->end_time_3],
        4 => ['is_open' => $request->is_open_4, 'start_time' => $request->start_time_4, 'end_time' => $request->end_time_4],
        5 => ['is_open' => $request->is_open_5, 'start_time' => $request->start_time_5, 'end_time' => $request->end_time_5],
        6 => ['is_open' => $request->is_open_6, 'start_time' => $request->start_time_6, 'end_time' => $request->end_time_6],
        0 => ['is_open' => $request->is_open_0, 'start_time' => $request->start_time_0, 'end_time' => $request->end_time_0]        
    ];

    $businessHours = BusinessHours::where('location_id', $id)->get()->keyBy('day');

    foreach ($days as $day => $data) {
        $isOpen = $data['is_open'];
        $_start = '';
        $_end = '';

        switch ($isOpen) {
            case 'all':
                $_start = '00:00';
                $_end = '24:00';
                break;
            case 'true':
                $_start = $data['start_time'];
                $_end = $data['end_time'];
                break;
            case 'false':
                $_start = '00:00';
                $_end = '00:00';
                break;
        }

        $businessHour = $businessHours->get($day);

        if ($businessHour) {
            $businessHour->update([
                'start_time' => $_start,
                'end_time' => $_end,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            BusinessHours::create([
                'location_id' => $id,
                'day' => $day,
                'start_time' => $_start,
                'end_time' => $_end,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    $updatedBusinessHours = BusinessHours::where('location_id', $id)->get();

    if ($updatedBusinessHours->count() > 0) {
        $data['status'] = true;
        $data['data'] = $updatedBusinessHours;
        $data['message'] = trans('app.update_successfully');
    } else {
        $data['status'] = false;
        $data['message'] = trans('app.please_try_again');
    }

    return response()->json($data);
}

    // public function update2(Request $request, $id)
    // {

    //     if (!auth()->user()->can('edit company')) {
    //         return Redirect::to("/")->withFail(trans('app.no_permissions'));
    //     }

    //     @date_default_timezone_set(session('app.timezone'));

    //     $_start = '';
    //     $_end = '';
        

    //     $isOpen = $request->is_open_1;
        
    //     switch ($isOpen) {
    //         case 'all':
    //             $_start = '00:00';
    //             $_end = '24:00';
    //             break;
    //         case 'true':
    //             $_start = $request->start_time_1;
    //             $_end = $request->end_time_1;
    //             break;
    //         case 'false':
    //             $_start = '00:00';
    //             $_end = '00:00';
    //             break;
    //     }

    //     $monday = BusinessHours::where('location_id', $id)->where('day', 1)->first();
    //     if ($monday) {
    //         $monday->start_time = $_start;
    //         $monday->end_time = $_end;
    //         $monday->updated_at = date('Y-m-d H:i:s');
    //         $monday->save();
    //     } else {
    //         $monday = BusinessHours::insert([
    //             'location_id'        => $id,
    //             'day'           => 1,
    //             'start_time' => $_start,
    //             'end_time'    => $_end,
    //             'created_at'  => date('Y-m-d H:i:s'),
    //             'updated_at'  => null,
    //         ]);          
    //     }

    //     $isOpen = $request->is_open_2;
        
    //     switch ($isOpen) {
    //         case 'all':
    //             $_start = '00:00';
    //             $_end = '24:00';
    //             break;
    //         case 'true':
    //             $_start = $request->start_time_2;
    //             $_end = $request->end_time_2;
    //             break;
    //         case 'false':
    //             $_start = '00:00';
    //             $_end = '00:00';
    //             break;
    //     }
    //     $tuesday = BusinessHours::where('location_id', $id)->where('day', 2)->first();
    //     if ($tuesday) {
    //         $tuesday->start_time = $_start;
    //         $tuesday->end_time = $_end;
    //         $tuesday->updated_at = date('Y-m-d H:i:s');
    //         $tuesday->save();
    //     } else {
    //         $tuesday = BusinessHours::insert([
    //             'location_id'        => $id,
    //             'day'           => 2,
    //             'start_time' => $_start,
    //             'end_time'    => $_end,
    //             'created_at'  => date('Y-m-d H:i:s'),
    //             'updated_at'  => null,
    //         ]);          
    //     }

    //     $update = [$monday,$tuesday];

    //     if ($update) {
    //         $data['status'] = true;
    //         $data['data'] = $update;
    //         $data['message'] = trans('app.update_successfully');
    //     } else {
    //         $data['status'] = false;
    //         $data['message'] = trans('app.please_try_again');
    //     }


    //     return response()->json($data);
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessHours $businessHours)
    {
        //
    }
}
