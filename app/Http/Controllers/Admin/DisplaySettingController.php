<?php

namespace App\Http\Controllers\Admin;

use App\Core\Data;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisplaySetting;
use App\Models\DisplayCustom;
use App\Models\Counter;
use App\Models\Department;
use App\Models\User;
use App\Models\Location;
use Carbon\Carbon;
use DB, Response, File, Validator;


class DisplaySettingController extends Controller
{

    public function showForm($id = null)
    {
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)->where('status', 1)->get();
        $location = Location::where('id', $id)->first();

        $setting  = DisplaySetting::firstWhere('location_id', $id);
        $counters = Counter::where('status', 1)->where('location_id', $id)->pluck('name', 'id');
        $customDisplays = DisplayCustom::where('location_id', $id)->get();

        $timezoneList = Data::getTimezoneDropDownList();
        $orientationList = Data::getPaperOrientation();
        $papersizeList = array();

        foreach (Data::getPaperSizes() as $key => $value) {
            $conv = 0.01389;
            $label = ucfirst($key) . " [" . round($value[2] * $conv, 2) . " in x " . round($value[3] * $conv, 2) . " in]";
            $papersizeList[$key] = $label;
        }


        // echo '<pre>';
        // print_r($papersizeList);
        // echo '</pre>';
        // die();
        //create default display setting if results are empty
        if (empty($setting)) {
            $insert = DisplaySetting::insert([
                'message'      => "SmartQ - Queue Management System",
                'color'        => "#3c8dbc",
                'background_color' => "#e0f7ff",
                'border_color' => "#3c8dbc",
                'direction'    => "left",
                'time_format'  => "H:i:s",
                'date_format'  => "d M, Y",
                'display'      => '1',
                'sms_alert'    => '1',
                'show_note'    => '0',
                'keyboard_mode' => '0',
                'alert_position' => '3',
                'language' => '',
                'title' => 'SmartQ - Queue Management System',
                'timezone' => 'America/Bogota',
                'paper_size' => 'a4',
                'paper_orientation' => 'portrait',
                'location_id' => $id,
            ]);

            $setting  = DisplaySetting::firstWhere('location_id', $id);
        }


        return view('pages.display.setting', compact(
            'setting',
            'counters',
            'customDisplays',
            'officers',
            'departments',
            'counters',
            'location',
            'timezoneList',
            'orientationList',
            'papersizeList'
        ));
    }

    public function setting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required',
            'color'       => 'max:20',
            'background_color' => 'max:20',
            'border_color' => 'max:20',
            'direction'   => 'max:10',
            'time_format' => 'max:20',
            'date_format' => 'max:20',
            'keyboard_mode' => 'max:1',
            'display'     => 'required|numeric',
            'sms_alert'   => 'required|numeric',
            'show_officer'    => 'required|numeric',
            'show_department' => 'required|numeric',
            'enable_greeting' => 'required|numeric',
            'client_reason_for_visit' => 'required|numeric',
            'enable_qr_checkin' => 'required|numeric',
            'enable_whatsapp' => 'required|numeric',
            'show_note'       => 'max:1',
            'alert_position'  => 'required|numeric|min:1|max:99',
            'lang'        => 'max:3',
            'timezone'    => 'required|max:100',
            'paper_size'    => 'required',
            'paper_orientation'    => 'required',
            'title'       => 'required|max:140'
        ])
            ->setAttributeNames(array(
                'color' => trans('app.color'),
                'background_color' => trans('app.background_color'),
                'border_color' => trans('app.border_color'),
                'direction' => trans('app.direction'),
                'time_format' => trans('app.time_format'),
                'date_format' => trans('app.date_format'),
                'display' => trans('app.display'),
                'keyboard_mode' => trans('app.keyboard_mode'),
                'sms_alert' => trans('app.sms_alert'),
                'show_officer' => trans('app.show_officer'),
                'show_department' => trans('app.show_department'),
                'enable_greeting' => trans('app.enable_greeting'),
                'enable_qr_checkin' => trans('app.enable_qr_checkin'),
                'client_reason_for_visit' => trans('app.client_reason_for_visit'),
                'enable_whatsapp' => trans('app.enable_whatsapp'),
                'show_note' => trans('app.show_note'),
                'alert_position' => trans('app.alert_position'),
                'lang' => trans('app.lang'),
                'timezone' => trans('app.timezone'),
                'paper_size' => trans('app.paper_size'),
                'paper_orientation' => trans('app.paper_orientation'),
                'title' => trans('app.title')
            ));


        if ($validator->fails()) {
            $data['status'] = true;
            $data['message'] = trans('app.please_try_again');
            $data['data'] = $data;
            return response()->json($data);
            // return redirect('display/setting')
            //     ->withErrors($validator)
            //     ->withInput();
        } else {

            if (!empty($request->id)) {
                //update data
                $update = DisplaySetting::where('id', $request->id)
                    ->update([
                        'id'           => $request->id,
                        'location_id'  => $request->location_id,
                        'message'      => $request->message,
                        'color'        => $request->color,
                        'background_color' => $request->background_color,
                        'border_color' => $request->border_color,
                        'direction'    => $request->direction,
                        'time_format'  => $request->time_format,
                        'date_format'  => $request->date_format,
                        'display'      => $request->display,
                        'keyboard_mode' => $request->keyboard_mode,
                        'sms_alert'    => $request->sms_alert,
                        'show_officer'  => $request->show_officer,
                        'show_department' => $request->show_department,
                        'enable_greeting' => $request->enable_greeting,
                        'enable_qr_checkin' => $request->enable_qr_checkin,
                        'enable_whatsapp' => $request->enable_whatsapp,
                        'client_reason_for_visit' => $request->client_reason_for_visit,
                        'show_note'       => $request->show_note,
                        'alert_position'  => $request->alert_position,
                        'language'  => $request->lang,
                        'timezone'  => $request->timezone,
                        'paper_size'  => $request->paper_size,
                        'paper_orientation'  => $request->paper_orientation,
                        'title'  => $request->title,
                    ]);

                if ($update) {
                    $data['status'] = true;
                    $data['message'] = trans('app.save_successfully');
                    return response()->json($data);
                } else {
                    $data['status'] = false;
                    $data['message'] = trans('app.please_try_again');
                    return response()->json($data);
                }
            }
        }
    }

    public function getCustom(Request $request)
    {
        $data   = [];

        // $result = DisplayCustom::find($request->id);
        $result = DisplayCustom::where('id', $request->id)->where('location_id', $request->location_id)->first();

        if ($result) {
            $data = [
                'status'  => true,
                'message' => 'Data found!',
                'data'    => $result
            ];
        } else {
            $data = [
                'status'  => false,
                'message' => 'Data not found!',
                'data'    => null
            ];
        }
        return response()->json($data);
    }

    public function custom(Request $request)
    {
        $id = $request->id;
        // echo $id;
        $validator = Validator::make($request->all(), [
            'name'        => 'required|min:1|max:128|unique:display_custom,name,' . $id,
            'description' => 'max:512',
            'counters'    => 'required|max:64',
            'status'      => 'required|max:1'
        ])
            ->setAttributeNames(array(
                'name'        => trans('app.name'),
                'description' => trans('app.description'),
                'counters'    => trans('app.counters'),
                'status'      => trans('app.status'),
            ));

        if ($validator->fails()) {
            $resError = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $resError[$key] = $value[0];
            }

            return response([
                'status'  => false,
                'message' => trans('app.validation_failed'),
                'data'    => $resError
            ]);
        } else {

            $postData = [
                'name'        => $request->name,
                'description' => $request->description,
                'counters'    => implode(',', $request->counters),
                'status'      => $request->status,
                'location_id' => $request->location_id,
            ];

            if (!empty($id)) {
                $store = DisplayCustom::where('id', $id)->update($postData);
            } else {
                $store = DisplayCustom::insert($postData);
            }

            if ($store) {

                $customDisplays = DisplayCustom::where('status', 1)->where('location_id', $request->location_id)->orderBy('name', 'ASC')->pluck('name', 'id');
                if (!empty($customDisplays)) {
                    \Session::put('custom_displays', $customDisplays);
                }

                return response([
                    'status'  => true,
                    'message' => !empty($id) ? trans('app.update_successfully') : trans('app.save_successfully'),
                    'data'    => ""
                ]);
            } else {
                return response([
                    'status'  => false,
                    'message' => trans('app.please_try_again'),
                    'data'    => ''
                ]);
            }
        }
    }
}
