<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BusinessCategory\BusinessCategoryDataTable;
use App\Models\BusinessCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BusinessCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BusinessCategoryDataTable $dataTable)
    {
        if (!auth()->user()->can('view business categories')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        return $dataTable->render('pages.businesscategory.list');
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
     * @param  \App\Http\Requests\StoreBusinessCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create business categories')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:business_categories,name|max:50',
            'description' => 'max:255',
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'description' => trans('app.description'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {           
            $category = BusinessCategory::create([
                'name'        => $request->name,
                'description' => $request->description,
            ]);

            if ($category) {
                $data['status'] = true;
                $data['data'] = $category;
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
     * @param  \App\Models\BusinessCategories  $businessCategories
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessCategory $businessCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessCategories  $businessCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCategory $businessCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusinessCategoriesRequest  $request
     * @param  \App\Models\BusinessCategories  $businessCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('edit business category')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));

        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:business_categories,name,' . $id,
            'description' => 'max:255',           
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'description' => trans('app.description'),                
            ));


        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {
           
            $update = BusinessCategory::where('id', $id)
                ->update([
                    'name'        => $request->name,
                    'description' => $request->description,                    
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
     * @param  \App\Models\BusinessCategories  $businessCategories
     * @return \Illuminate\Http\Response
     */
   
    public function destroy($id = null)
    {
        if (!auth()->user()->can('delete business category')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $delete = BusinessCategory::where('id', $id)
            ->delete();

        $data['status'] = true;
        $data['message'] = trans('app.company_deleted');

        return response()->json($data);
    }
}
