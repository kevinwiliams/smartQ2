<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Company\CompanyDataTable;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDataTable $dataTable)
    {
        $companies = Company::get();

        // echo '<pre>';
        // print_r($companies);
        // echo '</pre>';
        // die();
        return $dataTable->render('pages.admin.company.list');
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
        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:company,name|max:50',
            'description' => 'max:255',
            'address'      => 'required',
            'website'      => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'contact_person'      => 'required',
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'description' => trans('app.description'),
                'address' => trans('app.address'),
                'website' => trans('app.website'),
                'email' => trans('app.email'),
                'phone' => trans('app.phone'),
                'contact_person' => trans('app.contact_person'),
                'active' => trans('app.active'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {

            $save = Company::insert([
                'name'        => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'website' => $request->website,
                'email' => $request->email,
                'phone' => $request->phone,
                'contact_person' => $request->contact_person,
                'active' => ($request->active) ? $request->active : 0
            ]);

            if ($save) {
                $data['status'] = true;
                $data['data'] = $save;
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
    public function show(Company $company)
    {
        //
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
        @date_default_timezone_set(session('app.timezone'));

        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:company,name,' . $id,
            'description' => 'max:255',
            'address'      => 'required',
            'website'      => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'contact_person'      => 'required',
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'description' => trans('app.description'),
                'address' => trans('app.address'),
                'website' => trans('app.website'),
                'email' => trans('app.email'),
                'phone' => trans('app.phone'),
                'contact_person' => trans('app.contact_person'),
            ));


        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {

            $update = Company::where('id', $id)
                ->update([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'address' => $request->address,
                    'website' => $request->website,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'contact_person' => $request->contact_person,
                    'active' => ($request->active) ? $request->active : 0,
                    'updated_at' => Carbon::now()
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
        $delete = Company::where('id', $id)
            ->delete();

        $data['status'] = true;
        $data['message'] = trans('app.company_deleted');

        return response()->json($data);
    }
}
