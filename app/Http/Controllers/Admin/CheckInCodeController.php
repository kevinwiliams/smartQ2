<?php

namespace App\Http\Controllers\Admin;

use App\Core\Constants;
use App\Http\Controllers\Common\Utilities_lib;
use App\Http\Controllers\Controller;
use App\Models\CheckInCode;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckInCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
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

        $is_auto = false;
        $key_value = $location->getSettingByKey(Constants::Location_Settings_CheckInCode);

        if ($key_value == null) {
            $location->setSetting(Constants::Location_Settings_CheckInCode, 'manual');
        }

        $is_auto = ($key_value == 'auto') ? true : false;

        return view('pages.location.checkincodes.index', compact('location', 'departments', 'counters', 'officers', 'is_auto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regenerate($id)
    {
        $code = (new Utilities_lib)->generateNumericOTP(4);
        $newCheckInCode = new CheckInCode();
        $newCheckInCode->location_id = $id;
        $newCheckInCode->code = $code;
        $newCheckInCode->save();

        $data['status'] = true;
        $data['data'] = $code;
        return response()->json($data);
    }

    public function disable($id)
    {
        $location = Location::find($id);
        if ($location) {
            $location->setSetting(Constants::Location_Settings_CheckInCode, 'manual');
            $data['status'] = true;
            $data['meesage'] = trans('app.success');
            return response()->json($data);
        } else {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data);
        }
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
     * @param  \App\Models\CheckInCode  $checkInCode
     * @return \Illuminate\Http\Response
     */
    public function show(CheckInCode $checkInCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckInCode  $checkInCode
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckInCode $checkInCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckInCode  $checkInCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckInCode $checkInCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckInCode  $checkInCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckInCode $checkInCode)
    {
        //
    }
}
