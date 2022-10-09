<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VisitReason\VisitReasonDataTable;
use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Location;
use App\Models\ReasonForVisit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use Validator;

class ReasonForVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VisitReasonDataTable $dataTable, $id = null)
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

        $keyList = $this->keyList();
        $departmentlist = Department::where('location_id', auth()->user()->location_id)->orderBy('name')->pluck('name', 'id');
        // $info = Department::where('location_id', $id)->with('visitreasons')->first(); 
        // echo '<pre>';
        // print_r($info->visitreasons()->pluck('reason')->toArray());
        // echo '</pre>';
        // die();
        return $dataTable->with('deptlocation_id', $id)->render('pages.location.reasonforvisit.list', compact('keyList', 'location', 'departments', 'counters', 'officers', 'departmentlist'));
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
        if (!auth()->user()->can('create reason for visit')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        // echo 'here';
        // die();
        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'reason'        =>  Rule::unique('reason_for_visits')->where(fn ($query) => $query->where('department_id', $request->department_id)), //'required|unique:locations,name|max:50',
            // 'reason'        =>  'required|max:50',
            'department_id'      => 'required'
        ])
            ->setAttributeNames(array(
                'reason' => trans('app.reason'),
                'department_id' => trans('app.department')
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {

            ///Generate: default location
            $newreason = ReasonForVisit::create([
                'department_id' => $request->department_id,
                'reason'  => $request->reason
            ]);

            if ($newreason) {
                $data['status'] = true;
                $data['data'] = $newreason;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReasonForVisit  $reasonForVisit
     * @return \Illuminate\Http\Response
     */
    public function show(ReasonForVisit $reasonForVisit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReasonForVisit  $reasonForVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(ReasonForVisit $reasonForVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReasonForVisit  $reasonForVisit
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
            'reason'        =>  Rule::unique('reason_for_visits')->where(fn ($query) => $query->where('department_id', $request->department_id)), //'required|unique:locations,name|max:50',
            // 'reason'        =>  'required|max:50',
            'department_id'      => 'required'
        ])
            ->setAttributeNames(array(
                'reason' => trans('app.reason'),
                'department_id' => trans('app.department')
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {


            $update = ReasonForVisit::where('id', $id)
                ->update([
                    'reason' => $request->reason
                ]);

            if ($update) {
                $data['status'] = true;
                $data['data'] = $update;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReasonForVisit  $reasonForVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('delete reason for visit')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        try {
            ReasonForVisit::where('id', $id)
                ->delete();

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

    public function keyList()
    {
        $chars = array_merge(range('1', '9'), range('a', 'z'));
        $list = array();
        foreach ($chars as $char) {
            if ($char != "v")
                $list[$char] = $char;
        }
        return $list;
    }

    public function reasonsforvisit($id)
    {
        // try {
        $info = ReasonForVisit::where('department_id', $id)->orderBy('reason')->get();
        $data['data'] = $info;
        $data['status'] = true;
        $data['message'] = trans('app.visitreasons_retrieved_successfully');
        // } catch (\Throwable $th) {
        //     $data['status'] = false;
        //     $data['exception'] = trans('app.please_try_again');
        //     $data['errorObj'] = $th;
        // }

        return response()->json($data);
    }


    public function reasonsforvisitbylocation($id)
    {
        // try {
        $locationids = Department::where('location_id', auth()->user()->location_id)->pluck('id')->toArray();
        $info = ReasonForVisit::whereIn('department_id', $locationids)->orderBy('reason')->get();
        $data['data'] = $info;
        $data['status'] = true;
        $data['message'] = trans('app.visitreasons_retrieved_successfully');
        // } catch (\Throwable $th) {
        //     $data['status'] = false;
        //     $data['exception'] = trans('app.please_try_again');
        //     $data['errorObj'] = $th;
        // }

        return response()->json($data);
    }
}
