<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Location;
use App\Models\LocationSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocationSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\LocationSetting  $locationSetting
     * @return \Illuminate\Http\Response
     */
    public function show(LocationSetting $locationSetting)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationSetting  $locationSetting
     * @return \Illuminate\Http\Response
     */
    public function showAll($id)
    {
        if (!auth()->user()->can('view location settings')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
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
     
        // echo '<pre>';
        // print_r($location->locationSettings);
        // echo '</pre>';
        // die();
        return view('pages.location.appsettings.list', compact('location', 'departments', 'counters', 'officers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationSetting  $locationSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationSetting $locationSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationSetting  $locationSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationSetting $locationSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationSetting  $locationSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationSetting $locationSetting)
    {
        //
    }
}
