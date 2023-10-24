<?php

namespace App\Http\Controllers\Admin;

use App\Core\Data;
use App\DataTables\Company\CompanyDataTable;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\models\DisplayCustom;
use App\Models\DisplaySetting;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDataTable $dataTable)
    {
        if (!auth()->user()->can('view company')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $categories = BusinessCategory::get();
        return $dataTable->render('pages.company.list', compact('categories'));
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
            'name'        => 'required|unique:company,name|max:50',
            'shortname'        => 'nullable|unique:company,shortname|max:50',
            'description' => 'max:255',
            'address'      => 'required',
            'website'      => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'contact_person'      => 'required',
            'category_id'      => 'required',
            'logo'       => 'image|mimes:jpeg,png,jpg,gif|max:3072',
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'shortname' => trans('app.shortname'),
                'description' => trans('app.description'),
                'address' => trans('app.address'),
                'website' => trans('app.website'),
                'email' => trans('app.email'),
                'phone' => trans('app.phone'),
                'contact_person' => trans('app.contact_person'),
                'active' => trans('app.active'),
                'category_id' => trans('app.category_id'),
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['error'] = $validator->errors();
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 422);
        } else {
            $filePath = null;
            if (!empty($request->logo)) {
                $filePath = 'assets/img/logos/' . date('ymdhis') . '.jpg';
                $photo = $request->logo;
                Image::make($photo)->resize(300, 300)->save(public_path(Storage::url($filePath)));
            } else if (!empty($request->old_logo)) {
                $filePath = $request->old_logo;
                if ($request->has('remove_logo')) {
                    $filePath = null;
                }
            }

            $company = Company::create([
                'name'        => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'website' => $request->website,
                'email' => $request->email,
                'phone' => $request->phone,
                'logo' => $filePath,
                'contact_person' => $request->contact_person,
                'active' => ($request->active) ? $request->active : 0,
                'category_id' => $request->category_id,
                'shortname' => $request->shortname,
            ]);

            if ($company) {
                ///Generate: default location
                $location = Location::create([
                    'company_id' => $company->id,
                    'name'  => 'Default',
                    'address' =>  $request->address,
                    'lat' => 0,
                    'lon' => 0,
                    'active' => 0
                ]);

                ///Generate: default display settings
                $displaysettings = Data::getDefaultDisplay();
                $displaysettings['location_id'] = $location->id;
                $display = DisplaySetting::insert($displaysettings);


                $data['status'] = true;
                $data['data'] = $company;
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('view company')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $company = Company::find($id);
        $markers = array();
        $infowindows = array();

        foreach ($company->locations as $_location) {
            array_push($markers, array($_location->name, $_location->lat, $_location->lon));
            array_push($infowindows, array($_location->name, $_location->address));
        }

        // echo '<pre>';
        // print_r($company->category_name);
        // echo '</pre>';
        // die();
        $categories = BusinessCategory::get();
        return view('pages.company.view', compact('company', 'markers', 'infowindows','categories'));
    }


    public function getLocations($id)
    {        
        $locations = Location::where('company_id', $id)->where('active', 1)->has('departments')->with('settings')->whereRelation("company", "active", true)->get();
        // foreach ($locations as $location) {
        //     $blocked = auth()->user()-> ($location->id);
        //     if (!$blocked) { 
        //         $location->is_vip = (auth()->user()->isVipAtLocation($location->id)) ? 1 : 0;                
        //         $location->blocked = false;
        //     }else{
        //         $location->is_vip =  0;                
        //         $location->blocked = true;
        //     }
        // }

        // return response()->json($locations);
        $filteredLocations = collect();

        foreach ($locations as $location) {
            $blocked = auth()->user()->isBlockedAtLocation($location->id);

            if (!$blocked) {
                $location->is_vip = (auth()->user()->isVipAtLocation($location->id)) ? 1 : 0;
                $location->blocked = false;
                $filteredLocations->push($location);
            }
        }

        return response()->json($filteredLocations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('edit company')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));

        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:company,name,' . $id,
            'shortname'        => 'nullable|unique:company,shortname,' . $id,
            'description' => 'max:255',
            'address'      => 'required',
            'website'      => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'contact_person'      => 'required',
            'business_category_id'      => 'required',
            'logo'       => 'image|mimes:jpeg,png,jpg,gif|max:3072',
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'shortname' => trans('app.shortname'),
                'description' => trans('app.description'),
                'address' => trans('app.address'),
                'website' => trans('app.website'),
                'email' => trans('app.email'),
                'phone' => trans('app.phone'),
                'contact_person' => trans('app.contact_person'),
                'logo' => trans('app.logo'),
                'business_category_id' => trans('app.category_id'),
            ));


        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator->errors();
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 422);
        } else {
            $filePath = null;
            if (!empty($request->logo)) {
                $filePath = 'assets/img/logos/' . date('ymdhis') . '.jpg';
                $photo = $request->logo;
                Image::make($photo)->resize(300, 300)->save(public_path(Storage::url($filePath)));
            } else if (!empty($request->old_logo)) {
                $filePath = $request->old_logo;
                if ($request->has('remove_logo')) {
                    $filePath = null;
                }
            }

            $update = Company::where('id', $id)
                ->update([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'address' => $request->address,
                    'website' => $request->website,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'logo' => $filePath,
                    'contact_person' => $request->contact_person,
                    'active' => ($request->active) ? $request->active : 0,
                    'business_category_id' => $request->business_category_id,
                    'updated_at' => Carbon::now(),
                    'shortname' => $request->shortname
                ]);

            if ($update) {
                $data['status'] = true;
                $data['data'] = $update;
                $data['message'] = trans('app.update_successfully');
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */

    public function destroy($id = null)
    {
        if (!auth()->user()->can('delete company')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $delete = Company::where('id', $id)
            ->delete();

        $data['status'] = true;
        $data['message'] = trans('app.company_deleted');

        return response()->json($data);
    }
}
