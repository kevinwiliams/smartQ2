<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Blacklist\BlacklistDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blacklist;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BlacklistDataTable $dataTable, $id = null)
    {
        if (!auth()->user()->can('view blacklist')) {
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
        return $dataTable->with('location_id', $location)->render('pages.blacklist.list', compact('locations'));
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
     * @param  \App\Http\Requests\StoreBlacklistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create blacklist')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'location_id'        => 'required',
            'reason'      => 'required|max:255',
            'client_id'      => 'required',
            'duration'      => 'required',
        ])
            ->setAttributeNames(array(
                'location_id' => trans('app.location_id'),
                'reason' => trans('app.reason'),
                'client_id' => trans('app.client_id'),
                'duration' => trans('app.duration'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {

            $list = Blacklist::where('location_id', $request->location_id)->where('client_id', $request->client_id)->get();
            $exists = false;
            foreach ($list as $listitem) {
                if ($listitem->is_active) {
                    $exists = true;
                    break;
                }
            }

            if ($exists) {
                $data['status'] = true;
                $data['error'] = trans('app.user_aleady_blocked');
                $data['message'] = trans('app.validation_error');

                return response()->json($data, 400);
            }
            $block = Blacklist::create([
                'block_reason'        => $request->reason,
                'location_id' => $request->location_id,
                'client_id' => $request->client_id,
                'user_id' => auth()->user()->id,
                'block_date' => Carbon::now(),
                'unblock_date' => ($request->duration == -1) ? null : Carbon::now()->addDays($request->duration),
                'created_at' => Carbon::now()
            ]);

            if ($block) {

                $data['status'] = true;
                $data['data'] = $block;
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
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function show(Blacklist $blacklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Blacklist $blacklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlacklistRequest  $request
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('update blacklist')) {
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
            $vip = Blacklist::where('id', $id)
                ->update([
                    'unblock_reason'    => $request->reason,
                    'unblock_date'      => Carbon::now(),
                    'updated_at'        => Carbon::now()
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
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blacklist $blacklist)
    {
        //
    }
}
