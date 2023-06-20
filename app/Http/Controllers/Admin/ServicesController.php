<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Services\ServicesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Location;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServicesDataTable $dataTable, $id = null)
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

        $departmentlist = Department::where('location_id', $id)->orderBy('name')->pluck('name', 'id');

        return $dataTable->with('servlocation_id', $id)->render('pages.location.services.list', compact('location', 'departments', 'counters', 'officers', 'departmentlist'));
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
            'location_id'        =>  'required',
            'name'        =>  'required|max:50',
            'description'      => 'required',
            'price_range_start'      => 'required',
            'price_range_end'      => 'required'
        ])
            ->setAttributeNames(array(
                'location_id' => trans('app.location'),
                'name' => trans('app.name'),
                'description' => trans('app.description'),
                'price_range_start' => trans('app.price_range_start'),
                'price_range_end' => trans('app.price_range_end'),
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {

            ///Generate: default location
            $newservice = Services::create([
                'location_id' => $request->location_id,
                'name'  => $request->name,
                'description'  => $request->description,
                'price_range_start'  => (float) str_replace(',', '', $request->price_range_start),
                'price_range_end'  => (float) str_replace(',', '', $request->price_range_end),
                'status'  => ($request->has('status') ? $request->status : 0),
            ]);

            if ($newservice) {
                $data['status'] = true;
                $data['data'] = $newservice;
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
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('edit service')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        // echo 'here';
        // die();
        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [            
            'name'        =>  'required|max:50',
            'description'      => 'required',
            'price_range_start'      => 'required',
            'price_range_end'      => 'required'
        ])
        ->setAttributeNames(array(            
            'name' => trans('app.name'),
            'description' => trans('app.description'),
            'price_range_start' => trans('app.price_range_start'),
            'price_range_end' => trans('app.price_range_end'),
        ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {


            $update = Services::where('id', $id)
                ->update([
                    'name'  => $request->name,
                    'description'  => $request->description,
                    'price_range_start'  => (float) str_replace(',', '', $request->price_range_start),
                    'price_range_end'  => (float) str_replace(',', '', $request->price_range_end),
                    'status'  => ($request->has('status') ? $request->status : 0),
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
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        if (!auth()->user()->can('delete service')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        try {
            Services::where('id', $id)
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
}
