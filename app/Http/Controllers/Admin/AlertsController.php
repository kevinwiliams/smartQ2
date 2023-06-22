<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Alerts\AlertsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Support\Facades\Redirect;

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

    return $dataTable->with('location_id', $location)->render('pages.alerts.list');
  }

  // public function index()
  // {
  //   return view('pages.alerts.list');
  // }
}
