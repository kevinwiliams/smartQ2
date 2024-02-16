<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Location;
use App\Models\ReasonForVisitCounters;
use App\Models\TokenSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class ReasonForVisitCountersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (!auth()->user()->can('view location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)->first();

        // $keyList = $this->keyList();
        $departmentlist = Department::where('location_id', auth()->user()->location_id)->orderBy('name')->pluck('name', 'id');
        $info = TokenSetting::where('location_id', $id)->get();

        $data = collect();
        foreach ($info as  $value) {

            if (!$value->department || !$value->counter)
                continue;

            $tmp = collect();
            $tmp->department_id = $value->department_id;
            $tmp->department_name = $value->department->name;
            $tmp->counter_id = $value->counter_id;
            $tmp->counter_name = $value->counter->name;
            $tmp->reasons = $value->counter->visitreasons->pluck('reason')->toArray();
            $tmp->reason_ids = $value->counter->visitreasons->pluck('id')->toArray();
            $data->push($tmp);
        }
        // echo '<pre>';
        // print_r($data->where('department_name','Department 4'));
        // echo '</pre>';
        // die();

        return view('pages.location.reasonforvisitcounter.list', compact('data', 'location', 'departments', 'counters', 'officers', 'departmentlist'));
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
     * @param  \App\Models\ReasonForVisitCounters  $reasonForVisitCounters
     * @return \Illuminate\Http\Response
     */
    public function show(ReasonForVisitCounters $reasonForVisitCounters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReasonForVisitCounters  $reasonForVisitCounters
     * @return \Illuminate\Http\Response
     */
    public function edit(ReasonForVisitCounters $reasonForVisitCounters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReasonForVisitCounters  $reasonForVisitCounters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('create reason for visit')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        // echo 'here';
        // die();
        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'counter_id'      => 'required'
        ])
            ->setAttributeNames(array(
                'counter_id' => trans('app.counter')
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {


            $oldreasons = ReasonForVisitCounters::where('counter_id', $request->counter_id)->pluck('reason_id')->toArray();
            $deleteids = array_diff($oldreasons, $request->reason_id);
            $insertids = array_diff($request->reason_id, $oldreasons);

            $insertarray = array();

            foreach ($insertids as $key) {
                $insertarray[] = ['counter_id' => $request->counter_id, 'reason_id' => $key];
            }
            try {
                // echo '<pre>';
                // print_r($oldreasons);
                // echo '</pre>';
                // echo '<pre>';
                // print_r($deleteids);
                // echo '</pre>';
                // echo '<pre>';
                // print_r($insertarray);
                // echo '</pre>';

                ReasonForVisitCounters::where('counter_id', $request->counter_id)->whereIn('reason_id', $deleteids)->delete();
                ReasonForVisitCounters::insert($insertarray);


                $data['status'] = true;
                $data['message'] = trans('app.delete_successfully');
                return response()->json($data);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
                $data['errorObj'] = $th;
                return response()->json($data, 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReasonForVisitCounters  $reasonForVisitCounters
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReasonForVisitCounters $reasonForVisitCounters)
    {
        //
    }
}
