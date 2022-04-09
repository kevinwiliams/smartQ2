<?php

namespace App\Http\Controllers\Admin;

use App\Core\Data;
use App\DataTables\Location\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DisplaySetting;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LocationDataTable $dataTable)
    {
        $companies1 = Company::get();
        $companies = Company::where('active', 1)->pluck('name', 'id');

        // echo '<pre>';
        // print_r($companies);
        // echo '</pre>';
        // die();
        return $dataTable->render('pages.location.list', compact('companies'));
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
        if (!auth()->user()->can('create location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:company,name|max:50',
            'address'      => 'required',
            'company_id'      => 'required',
            'lat'      => 'required',
            'lng'      => 'required'
        ])
            ->setAttributeNames(array(
                'company_id' => trans('app.company'),
                'name' => trans('app.name'),
                'address' => trans('app.address'),
                'lat' => trans('app.lat'),
                'lng' => trans('app.lng'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {

            ///Generate: default location
            $location = Location::create([
                'company_id' => $request->company_id,
                'name'  => $request->name,
                'address' =>  $request->address,
                'lat' => $request->lat,
                'lon' => $request->lng,
                'active' => ($request->has('active')) ? 1 : 0
            ]);

            if ($location) {
                ///Generate: default display settings
                $displaysettings = Data::getDefaultDisplay();
                $displaysettings['location_id'] = $location->id;
                $display = DisplaySetting::insert($displaysettings);


                $data['status'] = true;
                $data['data'] = $location;
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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
