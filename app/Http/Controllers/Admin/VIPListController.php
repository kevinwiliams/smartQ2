<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VIPList\VIPListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\VIPList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VIPListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VIPListDataTable $dataTable, $id = null)
    {
        if (!auth()->user()->can('view vip list')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $location = auth()->user()->location_id;

        if ($id != null)
            $location = $id;

        // $alert  = Alert::with('locations')->first();
        // echo '<pre>';
        // print_r($location);
        // echo '<pre>';
        // die();
        $locations = Location::where('id', auth()->user()->location_id)->first()->company->locations;
        // $test  =VIPList::first();
        // echo '<pre>';
        // print_r($test->client);
        // echo '<pre>';
        // die();
        return $dataTable->with('location_id', $location)->render('pages.viplist.list', compact('locations'));
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
        if (!auth()->user()->can('create company')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'location_id'        => 'required',
            'reason'      => 'required|max:255',
            'client_id'      => 'required',
        ])
            ->setAttributeNames(array(
                'location_id' => trans('app.location_id'),
                'reason' => trans('app.reason'),
                'client_id' => trans('app.client_id'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {

            $exists = VIPList::where('location_id', $request->location_id)->where('user_id', auth()->user()->id)->first();
            if ($exists) {
                $data['status'] = true;
                $data['error'] = trans('app.vip_exists');
                $data['message'] = trans('app.validation_error');

                return response()->json($data);
            }
            $vip = VIPList::create([
                'reason'        => $request->reason,
                'location_id' => $request->location_id,
                'client_id' => $request->client_id,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()
            ]);

            if ($vip) {

                $data['status'] = true;
                $data['data'] = $vip;
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
     * @param  \App\Models\VIPList  $vIPList
     * @return \Illuminate\Http\Response
     */
    public function show(VIPList $vIPList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VIPList  $vIPList
     * @return \Illuminate\Http\Response
     */
    public function edit(VIPList $vIPList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VIPList  $vIPList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('update viplist')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'reason'        => 'required|max:255'
        ])
            ->setAttributeNames(array(
                'reason' => trans('app.reason'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {
            $vip = VIPList::where('id', $id)
                ->update([
                    'reason'        => $request->reason,
                    'updated_at' => Carbon::now()
                ]);

            if ($vip) {

                $data['status'] = true;
                $data['data'] = $vip;
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
     * @param  \App\Models\VIPList  $vIPList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        if (!auth()->user()->can('delete alert')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $delete = VIPList::where('id', $id)
            ->delete();

        $data['status'] = true;
        $data['message'] = trans('app.vip_deleted');

        return response()->json($data);
    }
}
