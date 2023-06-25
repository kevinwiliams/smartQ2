<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Alerts\AlertsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\AlertLocations;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AlertsController extends Controller
{
  public function index(AlertsDataTable $dataTable)
  {
    if (!auth()->user()->can('view location')) {
      return Redirect::to("/")->withFail(trans('app.no_permissions'));
    }


    $location = auth()->user()->location_id;

    // $alert  = Alert::with('locations')->first();
    // echo '<pre>';
    // print_r($alert->location_keys);
    // echo '<pre>';
    // die();
    $locations = Location::where('id', auth()->user()->location_id)->first()->company->locations;
    // echo '<pre>';
    // print_r($locations);
    // echo '<pre>';
    // die();
    return $dataTable->with('location_id', $location)->render('pages.alerts.list', compact('locations'));
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
      'title'        => 'required|max:50',
      'message'      => 'max:255',
      'start_date'      => 'required',
      'end_date'      => 'required',
      'image_url'       => 'image|mimes:jpeg,png,jpg,gif|max:3072',
    ])
      ->setAttributeNames(array(
        'title' => trans('app.title'),
        'message' => trans('app.message'),
        'start_date' => trans('app.start_date'),
        'end_date' => trans('app.end_date'),
        'image_url' => trans('app.image_url'),
      ));

    if ($validator->fails()) {
      $data['status'] = true;
      $data['error'] = $validator;
      $data['message'] = trans('app.validation_error');

      return response()->json($data);
    } else {
      $filePath = null;
      if (!empty($request->logo)) {
        $filePath = 'assets/img/alerts/' . date('ymdhis') . '.jpg';
        $photo = $request->logo;
        Image::make($photo)->save(public_path(Storage::url($filePath)));
      } else if (!empty($request->old_logo)) {
        $filePath = $request->old_logo;
        if ($request->has('remove_logo')) {
          $filePath = null;
        }
      }

      $alert = Alert::create([
        'title'        => $request->title,
        'message' => $request->message,
        'start_date' =>Carbon::parse($request->start_date),
        'end_date' => Carbon::parse($request->end_date),
        'active' => ($request->active) ? $request->active : 0,
        'image_url' => $filePath,
        'user_id' => auth()->user()->id,
        'created_at' => Carbon::now()
      ]);

      if ($alert) {
        ///Generate: default location
        $location_ids = explode(",", request('locations'));
        foreach ($location_ids as $locid) {
          $location = AlertLocations::create([
            'alert_id' => $alert->alert_id,
            'location_id'  => $locid
          ]);
        }

        $data['status'] = true;
        $data['data'] = $alert;
        $data['message'] = trans('app.save_successfully');
      } else {
        $data['status'] = false;
        $data['message'] = trans('app.please_try_again');
      }


      return response()->json($data);
    }
  }

  public function update(Request $request, $id)
  {
    if (!auth()->user()->can('update alert')) {
      return Redirect::to("/")->withFail(trans('app.no_permissions'));
    }

    @date_default_timezone_set(session('app.timezone'));
    $validator = Validator::make($request->all(), [
      'title'        => 'required|max:50',
      'message'      => 'max:255',
      'start_date'      => 'required',
      'end_date'      => 'required',
      'image_url'       => 'image|mimes:jpeg,png,jpg,gif|max:3072',
    ])
      ->setAttributeNames(array(
        'title' => trans('app.title'),
        'message' => trans('app.message'),
        'start_date' => trans('app.start_date'),
        'end_date' => trans('app.end_date'),
        'image_url' => trans('app.image_url'),
      ));

    if ($validator->fails()) {
      $data['status'] = true;
      $data['error'] = $validator;
      $data['message'] = trans('app.validation_error');

      return response()->json($data);
    } else {
      $filePath = null;
      if (!empty($request->logo)) {
        $filePath = 'assets/img/alerts/' . date('ymdhis') . '.jpg';
        $photo = $request->logo;
        Image::make($photo)->save(public_path(Storage::url($filePath)));
      } else if (!empty($request->old_logo)) {
        $filePath = $request->old_logo;
        if ($request->has('remove_logo')) {
          $filePath = null;
        }
      }

      $alert = Alert::where('alert_id', $id)
        ->update([
          'title'        => $request->title,
          'message' => $request->message,
          'start_date' => Carbon::parse($request->start_date),
          'end_date' => Carbon::parse($request->end_date),
          'active' => ($request->active) ? $request->active : 0,
          'image_url' => $filePath,
          'updated_at' => Carbon::now()
        ]);

      if ($alert) {
        AlertLocations::where('alert_id', $id)->delete();
        $location_ids = explode(",", request('locations'));
        foreach ($location_ids as $locid) {
          $location = AlertLocations::create([
            'alert_id' => $id,
            'location_id'  => $locid
          ]);
        }

        $data['status'] = true;
        $data['data'] = $alert;
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
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */

  public function destroy($id = null)
  {
    if (!auth()->user()->can('delete alert')) {
      return Redirect::to("/")->withFail(trans('app.no_permissions'));
    }

    $deleteRelations = AlertLocations::where('alert_id', $id)
      ->delete();
    $delete = Alert::where('alert_id', $id)
      ->delete();

    $data['status'] = true;
    $data['message'] = trans('app.alert_deleted');

    return response()->json($data);
  }
  // public function index()
  // {
  //   return view('pages.alerts.list');
  // }
}
