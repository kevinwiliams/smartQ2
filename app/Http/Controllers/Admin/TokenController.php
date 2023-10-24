<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Token\TokenDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\SMS_lib;
use App\Http\Controllers\Common\Token_lib;
use App\Http\Controllers\Common\Utilities_lib;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\BusinessCategory;
use App\Models\CheckInCodes;
use App\Models\Company;
use App\Models\User;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Token;
use App\Models\DisplaySetting;
use App\Models\TokenSetting;
use App\Models\SmsSetting;
use App\Models\Location;
use App\Models\ReasonForVisit;
use App\Models\ReasonForVisitCounters;
use App\Models\Setting;
use App\Models\SmsHistory;
use App\Models\TokenStatus;
use Carbon\Carbon;

use DB, Validator, PDF;
use Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TokenController extends Controller
{

    /*-----------------------------------
    | AUTO TOKEN SETTING
    |-----------------------------------*/
    public function history()
    {
        return view('pages.token.history');
    }

    public function tokenSettingView($id = null)
    {

        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)->first();


        $tokens = TokenSetting::select('token_setting.*', 'department.name as department', 'counter.name as counter', 'user.firstname', 'user.lastname')
            ->leftJoin('department', 'token_setting.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token_setting.counter_id', '=', 'counter.id')
            ->leftJoin('user', 'token_setting.user_id', '=', 'user.id')
            ->groupBy('token_setting.location_id', 'department', 'token_setting.user_id')
            ->where('token_setting.location_id', $id)
            ->orderBy('department')
            ->get();

        $countertList = Counter::select('counter.*', 'token_setting.counter_id')
            ->leftJoin('token_setting', 'counter.id', '=', 'token_setting.counter_id')
            ->where('counter.location_id', $id)
            ->where('counter.status', 1)
            ->whereNull('token_setting.counter_id')
            ->pluck('name', 'id');


        $departmentList = Department::where('status', 1)
            ->where('location_id', $id)
            ->pluck('name', 'id');

        $userList = User::select('user.id', DB::raw('CONCAT(user.firstname, " ", user.lastname) as full_name'))
            ->leftJoin('token_setting', 'user.id', '=', 'token_setting.user_id')
            ->where('user.user_type', 1)
            ->where('user.location_id', $id)
            ->where('user.status', 1)
            ->whereNull('token_setting.user_id')
            ->orderBy('user.firstname', 'ASC')
            ->pluck('full_name', 'user.id');

        return view('pages.token.setting', compact('tokens', 'countertList', 'departmentList', 'userList', 'officers', 'counters', 'departments', 'location'));
    }

    public function tokenSetting(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));


        $validator = Validator::make($request->all(), [
            'department_id' => 'required|max:11',
            'counter_id'    => 'required|unique:token_setting,counter_id|max:11',
            'user_id'       => 'required|unique:token_setting,user_id|max:11'
        ])
            ->setAttributeNames(array(
                'department_id' => trans('app.department'),
                'counter_id' => trans('app.counter'),
                'user_id' => trans('app.officer')
            ));

        if ($validator->fails()) {
            return redirect('token/setting')
                ->withErrors($validator)
                ->withInput();
        } else {

            $check = TokenSetting::where('department_id', $request->department_id)
                ->where('counter_id', $request->counter_id)
                ->where('location_id', $request->location_id)
                ->where('user_id', $request->user_id)
                ->count();
            if ($check > 0) {
                return back()->with('exception', trans('app.setup_already_exists'))
                    ->withInput();
            }

            $save = TokenSetting::insert([
                'location_id' => $request->location_id,
                'department_id' => $request->department_id,
                'counter_id'    => $request->counter_id,
                'user_id'       => $request->user_id,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => null,
                'status'        => 1
            ]);

            if ($save) {
                return back()->withInput()->with('message',  trans('app.setup_successfully'));
            } else {
                return back()->withInput()->with('exception', trans('app.please_try_again'));
            }
        }
    }

    public function tokenDeleteSetting($id = null)
    {
        TokenSetting::where('id', $id)->delete();
        return back()->with('message', trans('app.delete_successfully'));
    }


    /*-----------------------------------
    | AUTO TOKEN 
    |-----------------------------------*/

    public function tokenAutoView(TokenDataTable $dataTable)
    {
        if (!auth()->user()->can('view token')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $display = DisplaySetting::where('location_id', auth()->user()->location_id)->first();
        $keyList = DB::table('token_setting AS s')
            ->select('d.key', 's.department_id', 's.counter_id', 's.user_id')
            ->leftJoin('department AS d', 'd.id', '=', 's.department_id')
            ->where('s.location_id', auth()->user()->location_id)
            ->where('s.status', 1)
            ->get();
        $keyList = json_encode($keyList);

        if ($display->display == 5) {
            $departmentList = TokenSetting::select(
                'department.id',
                'department.name',
                'department.description',
                'token_setting.department_id',
                'counter.name as countername',
                'token_setting.counter_id',
                'token_setting.user_id',
                DB::raw('CONCAT(user.firstname ," " ,user.lastname) AS officer')
            )
                ->join('department', 'department.id', '=', 'token_setting.department_id')
                ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
                ->join('user', 'user.id', '=', 'token_setting.user_id')
                ->join('locations', 'locations.id', '=', 'token_setting.location_id')
                ->where('token_setting.status', 1)
                ->where('token_setting.location_id', auth()->user()->location_id)
                ->groupBy('token_setting.user_id')
                ->orderBy('token_setting.department_id', 'ASC')
                ->get();
        } else {
            $departmentList = TokenSetting::select(
                'department.id',
                'department.name',
                'token_setting.department_id',
                'token_setting.counter_id',
                'token_setting.user_id',
                'counter.name as countername'
            )
                ->join('department', 'department.id', '=', 'token_setting.department_id')
                ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
                ->join('user', 'user.id', '=', 'token_setting.user_id')
                ->join('locations', 'locations.id', '=', 'token_setting.location_id')
                ->where('token_setting.status', 1)
                ->where('token_setting.location_id', auth()->user()->location_id)
                ->groupBy('token_setting.department_id')
                ->groupBy('token_setting.location_id')
                ->get();
        }

        // echo $display->display;
        // echo '<pre>';
        // print_r($departmentList);
        // echo '</pre>';
        // die();
        @date_default_timezone_set(session('app.timezone'));
        $waiting = Token::where('status', '0')->where('location_id', auth()->user()->location_id)->count();
        $counters = Counter::where('status', 1)->where('location_id', auth()->user()->location_id)->pluck('name', 'id');
        $officers = User::select('id', DB::raw('CONCAT(firstname, " ", lastname) as full_name'))
            ->where('user_type', 1)
            ->where('status', 1)
            ->where('location_id', auth()->user()->location_id)
            ->orderBy('full_name', 'ASC')
            ->pluck('full_name', 'id');

        return $dataTable->with('token_location_id', auth()->user()->location_id)->render('pages.token.auto', compact('display', 'departmentList', 'keyList', 'counters', 'officers', 'waiting'));


        // return view('pages.token.auto', compact('display', 'departmentList', 'keyList'));
    }

    public function tokenAuto(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $display = DisplaySetting::first();

        if ($display->sms_alert) {
            $validator = Validator::make($request->all(), [
                'client_mobile' => 'required',
                'department_id' => 'required|max:11',
                'counter_id'    => 'required|max:11',
                'user_id'       => 'required|max:11',
                'note'          => 'max:512'
            ])
                ->setAttributeNames(array(
                    'client_mobile' => trans('app.client_mobile'),
                    'department_id' => trans('app.department'),
                    'counter_id' => trans('app.counter'),
                    'user_id' => trans('app.officer'),
                    'note' => trans('app.note')
                ));
        } else {
            $validator = Validator::make($request->all(), [
                'department_id' => 'required|max:11',
                'counter_id'    => 'required|max:11',
                'user_id'       => 'required|max:11',
                'note'          => 'max:512'
            ])
                ->setAttributeNames(array(
                    'department_id' => trans('app.department'),
                    'counter_id' => trans('app.counter'),
                    'user_id' => trans('app.officer'),
                    'note' => trans('app.note')
                ));
        }

        //generate a token
        try {
            DB::beginTransaction();

            if ($validator->fails()) {
                $data['status'] = false;
                $data['exception'] = "<ul class='list-unstyled'>";
                $messages = $validator->messages();
                foreach ($messages->all('<li>:message</li>') as $message) {
                    $data['exception'] .= $message;
                }
                $data['exception'] .= "</ul>";
            } else {

                //find auto-setting
                // $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                //     ->where('department_id', $request->department_id)
                //     ->groupBy('user_id')
                //     ->get();

                $settings = null;


                // echo '<pre>';
                // // echo $display->display;
                // print_r($settings);
                // echo '</pre>';
                // die();

                //Get user by mobile number
                $clientuser = User::where('mobile', $request->client_mobile)->first();

                //if auto-setting are available
                if (!empty($settings)) {

                    foreach ($settings as $setting) {
                        //compare each user in today
                        $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                            ->where('department_id', $setting->department_id)
                            ->where('counter_id', $setting->counter_id)
                            ->where('user_id', $setting->user_id)
                            ->where('status', 0)
                            ->whereRaw('DATE(created_at) = CURDATE()')
                            ->orderBy('total_tokens', 'asc')
                            ->groupBy('user_id')
                            ->first();

                        //create user counter list
                        $tokenAssignTo[] = [
                            'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                            'department_id' => $setting->department_id,
                            'counter_id'    => $setting->counter_id,
                            'user_id'       => $setting->user_id
                        ];
                    }

                    // echo '<pre>';
                    // // echo $display->display;
                    // print_r($tokenAssignTo);
                    // echo '</pre>';
                    // die();

                    //findout min counter set to 
                    $min = min($tokenAssignTo);
                    $saveToken = [
                        'token_no'      => (new Token_lib)->newToken($min['department_id'], $min['counter_id'], $request->is_vip),
                        'client_mobile' => $request->client_mobile,
                        'department_id' => $min['department_id'],
                        'counter_id'    => $min['counter_id'],
                        'user_id'       => $min['user_id'],
                        'client_id'       => (!empty($clientuser) ? $clientuser->id : null),
                        'note'          => $request->note,
                        'is_vip'        => $request->is_vip,
                        'created_by'    => auth()->user()->id,
                        'location_id'    => auth()->user()->location_id,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => null,
                        'status'        => 0
                    ];
                } else {
                    $saveToken = [
                        'token_no'      => (new Token_lib)->newToken($request->department_id, $request->counter_id, $request->is_vip),
                        'client_mobile' => $request->client_mobile,
                        'department_id' => $request->department_id,
                        'counter_id'    => $request->counter_id,
                        'user_id'       => $request->user_id,
                        'client_id'       => (!empty($clientuser) ? $clientuser->id : null),
                        'note'          => $request->note,
                        'is_vip'        => $request->is_vip,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => auth()->user()->id,
                        'location_id'    => auth()->user()->location_id,
                        'updated_at'    => null,
                        'status'        => 0
                    ];
                }

                //store in database  
                //set message and redirect
                if ($insert_id = Token::insertGetId($saveToken)) {
                    //Insert token status                    
                    $save = TokenStatus::insert([
                        'token_id'    => $insert_id,
                        'status'      => 0,
                        'time_stamp' => date('Y-m-d H:i:s')
                    ]);

                    $token = null;
                    //retrive token info
                    $token = Token::select(
                        'token.*',
                        'department.name as department',
                        'counter.name as counter',
                        'user.firstname',
                        'user.lastname'
                    )
                        ->leftJoin('department', 'token.department_id', '=', 'department.id')
                        ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                        ->leftJoin('user', 'token.user_id', '=', 'user.id')
                        ->where('token.id', $insert_id)
                        ->first();

                    DB::commit();
                    $data['status'] = true;
                    $data['message'] = trans('app.token_generate_successfully');
                    $data['token']  = $token;
                } else {
                    $data['status'] = false;
                    $data['exception'] = trans('app.please_try_again');
                }
            }

            return response()->json($data);
        } catch (\Exception $err) {
            DB::rollBack();
        }
    }

    public function clientTokenAuto(Request $request)
    {
        if (empty(session('app.timezone'))) {
            $setting = DisplaySetting::where('location_id', $request->location)->first();
            session(['app.timezone' => $setting->timezone]);
            $value = session('app.timezone');
        }

        @date_default_timezone_set(session('app.timezone'));

        $client_id = auth()->user()->id;
        $client_mobile = auth()->user()->mobile;
        $otp_type = auth()->user()->otp_type;

        //generate a token
        try {
            DB::beginTransaction();

            $reason = null;
            //find auto-setting
            if (!empty($request->reason_id)) {
                $reason = ReasonForVisit::find($request->reason_id);
                $counters = ReasonForVisitCounters::where('reason_id', $request->reason_id)->pluck('counter_id')->toArray();
                $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                    ->whereIn('counter_id', $counters)
                    ->groupBy('user_id')
                    ->get();
            } else {
                $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                    ->where('department_id', $request->department_id)
                    ->groupBy('user_id')
                    ->get();
            }

            //if auto-setting are available
            if (!empty($settings)) {

                foreach ($settings as $setting) {
                    //compare each user in today
                    $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                        ->where('department_id', $setting->department_id)
                        ->where('counter_id', $setting->counter_id)
                        ->where('user_id', $setting->user_id)
                        ->whereIn('status', [0, 3])
                        ->whereRaw('DATE(created_at) = CURDATE()')
                        ->orderBy('total_tokens', 'asc')
                        ->groupBy('user_id')
                        ->first();

                    //create user counter list
                    $tokenAssignTo[] = [
                        'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                        'department_id' => $setting->department_id,
                        'counter_id'    => $setting->counter_id,
                        'user_id'       => $setting->user_id
                    ];
                }

                $isvip = auth()->user()->isVipAtLocation($request->location);
                //findout min counter set to 
                $min = min($tokenAssignTo);
                $saveToken = [
                    'token_no'      => (new Token_lib)->newToken($min['department_id'], $min['counter_id']),
                    'location_id'   => $request->location,
                    'client_mobile' => $client_mobile,
                    'client_id'     => $client_id,
                    'department_id' => $min['department_id'],
                    'counter_id'    => $min['counter_id'],
                    'user_id'       => $min['user_id'],
                    'note'          => (!empty($request->note)) ? $request->note : null,
                    'reason_for_visit'          => ($reason != null) ? $reason->reason : null,
                    'lat'          => (!empty($request->lat)) ? $request->lat : null,
                    'lng'          => (!empty($request->lng)) ? $request->lng : null,
                    'is_vip'       => ($isvip) ? 1 : null,
                    'created_by'    => auth()->user()->id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => null,
                    'status'        => 3, //booked
                    'notification_type' => $otp_type
                ];


                //store in database  
                //set message and redirect
                if ($insert_id = Token::insertGetId($saveToken)) {
                    //Insert token status                    
                    $save = TokenStatus::insert([
                        'token_id'    => $insert_id,
                        'status'      => 3,
                        'time_stamp' => date('Y-m-d H:i:s')
                    ]);

                    $token = null;
                    //retrive token info
                    $token = Token::select(
                        'token.*',
                        'department.name as department',
                        'counter.name as counter',
                        'user.firstname',
                        'user.lastname'
                    )
                        ->leftJoin('department', 'token.department_id', '=', 'department.id')
                        ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                        ->leftJoin('user', 'token.user_id', '=', 'user.id')
                        ->where('token.id', $insert_id)
                        ->first();

                    DB::commit();

                    $list = Token::where('status', 0)
                        ->where('department_id', $saveToken["department_id"])
                        ->where('counter_id', $saveToken["counter_id"])
                        ->orderBy('id')->get();
                    $cntr = 1;
                    foreach ($list as $value) {
                        if ($value->token_no == $saveToken["token_no"]) {
                            break;
                        }
                        $cntr++;
                    }
                    $data['status'] = true;
                    $data['message'] = trans('app.token_generate_successfully');
                    $data['token']  = $token;
                    $data['position']  = $cntr;

                    activity('activity')
                        ->withProperties(['activity' => 'Client Generate Token', 'department' => $token->department, 'token' => $token->token_no, 'display' => 'success', 'location_id' => auth()->user()->location_id])
                        ->log('Token (:properties.token) generated for :properties.department');
                } else {
                    $data['status'] = false;
                    $data['exception'] = trans('app.please_try_again');
                }



                return response()->json($data);
            }
        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json($err->getMessage());
        }
    }

    public function clientRebook(Request $request)
    {
        $oldToken = Token::find($request->id);

        if (empty(session('app.timezone'))) {
            $setting = DisplaySetting::where('location_id', $oldToken->location_id)->first();
            session(['app.timezone' => $setting->timezone]);
            $value = session('app.timezone');
        }

        @date_default_timezone_set(session('app.timezone'));

        $client_id = auth()->user()->id;
        $client_mobile = auth()->user()->mobile;
        $otp_type = auth()->user()->otp_type;

        //generate a token
        try {
            DB::beginTransaction();

            $reason = null;
            //find auto-setting

            $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                ->where('department_id', $oldToken->department_id)
                ->groupBy('user_id')
                ->get();


            //if auto-setting are available
            if (!empty($settings)) {

                foreach ($settings as $setting) {
                    //compare each user in today
                    $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                        ->where('department_id', $setting->department_id)
                        ->where('counter_id', $setting->counter_id)
                        ->where('user_id', $setting->user_id)
                        ->whereIn('status', [0, 3])
                        ->whereRaw('DATE(created_at) = CURDATE()')
                        ->orderBy('total_tokens', 'asc')
                        ->groupBy('user_id')
                        ->first();

                    //create user counter list
                    $tokenAssignTo[] = [
                        'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                        'department_id' => $setting->department_id,
                        'counter_id'    => $setting->counter_id,
                        'user_id'       => $setting->user_id
                    ];
                }

                $isvip = auth()->user()->isVipAtLocation($oldToken->location_id);
                //findout min counter set to 
                $min = min($tokenAssignTo);
                $saveToken = [
                    'token_no'      => (new Token_lib)->newToken($min['department_id'], $min['counter_id']),
                    'location_id'   => $oldToken->location_id,
                    'client_mobile' => $client_mobile,
                    'client_id'     => $client_id,
                    'department_id' => $min['department_id'],
                    'counter_id'    => $min['counter_id'],
                    'user_id'       => $min['user_id'],
                    'note'          => (!empty($oldToken->note)) ? $oldToken->note : null,
                    'reason_for_visit'          => ($oldToken->reason_for_visit != null) ? $oldToken->reason_for_visit : null,
                    'lat'          => (!empty($request->lat)) ? $request->lat : null,
                    'lng'          => (!empty($request->lng)) ? $request->lng : null,
                    'is_vip'       => ($isvip) ? 1 : null,
                    'created_by'    => auth()->user()->id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => null,
                    'status'        => 3, //booked
                    'notification_type' => $otp_type
                ];


                //store in database  
                //set message and redirect
                if ($insert_id = Token::insertGetId($saveToken)) {
                    //Insert token status                    
                    $save = TokenStatus::insert([
                        'token_id'    => $insert_id,
                        'status'      => 3,
                        'time_stamp' => date('Y-m-d H:i:s')
                    ]);

                    $token = null;
                    //retrive token info
                    $token = Token::select(
                        'token.*',
                        'department.name as department',
                        'counter.name as counter',
                        'user.firstname',
                        'user.lastname'
                    )
                        ->leftJoin('department', 'token.department_id', '=', 'department.id')
                        ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                        ->leftJoin('user', 'token.user_id', '=', 'user.id')
                        ->where('token.id', $insert_id)
                        ->first();

                    DB::commit();

                    $list = Token::where('status', 0)
                        ->where('department_id', $saveToken["department_id"])
                        ->where('counter_id', $saveToken["counter_id"])
                        ->orderBy('id')->get();
                    $cntr = 1;
                    foreach ($list as $value) {
                        if ($value->token_no == $saveToken["token_no"]) {
                            break;
                        }
                        $cntr++;
                    }
                    $data['status'] = true;
                    $data['message'] = trans('app.token_generate_successfully');
                    $data['token']  = $token;
                    $data['position']  = $cntr;

                    activity('activity')
                        ->withProperties(['activity' => 'Client Generate Token', 'department' => $token->department, 'token' => $token->token_no, 'display' => 'success', 'location_id' => auth()->user()->location_id])
                        ->log('Token (:properties.token) generated for :properties.department');
                } else {
                    $data['status'] = false;
                    $data['exception'] = trans('app.please_try_again');
                }



                return response()->json($data);
            }
        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json($err->getMessage());
        }
    }
    public function clientTokenTransfer(Request $request)
    {
        if (empty(session('app.timezone'))) {
            $setting = DisplaySetting::where('location_id', $request->location)->first();
            session(['app.timezone' => $setting->timezone]);
            $value = session('app.timezone');
        }

        @date_default_timezone_set(session('app.timezone'));

        $client_id = auth()->user()->id;
        $client_mobile = auth()->user()->mobile;
        $otp_type = auth()->user()->otp_type;

        //generate a token
        try {
            DB::beginTransaction();

            $reason = null;
            //find auto-setting
            if (!empty($request->reason_id)) {
                $reason = ReasonForVisit::find($request->reason_id);
                $counters = ReasonForVisitCounters::where('reason_id', $request->reason_id)->pluck('counter_id')->toArray();
                $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                    ->whereIn('counter_id', $counters)
                    ->groupBy('user_id')
                    ->get();
            } else {
                $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                    ->where('department_id', $request->department_id)
                    ->groupBy('user_id')
                    ->get();
            }

            //if auto-setting are available
            if (!empty($settings)) {

                foreach ($settings as $setting) {
                    //compare each user in today
                    $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                        ->where('department_id', $setting->department_id)
                        ->where('counter_id', $setting->counter_id)
                        ->where('user_id', $setting->user_id)
                        ->whereIn('status', [0, 3])
                        ->whereRaw('DATE(created_at) = CURDATE()')
                        ->orderBy('total_tokens', 'asc')
                        ->groupBy('user_id')
                        ->first();

                    //create user counter list
                    $tokenAssignTo[] = [
                        'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                        'department_id' => $setting->department_id,
                        'counter_id'    => $setting->counter_id,
                        'user_id'       => $setting->user_id
                    ];
                }

                //findout min counter set to 
                $min = min($tokenAssignTo);
                $oldToken = Token::find($request->id);
                $oldToken->token_no = (new Token_lib)->newToken($min['department_id'], $min['counter_id']);
                $oldToken->location_id = $request->location;
                $oldToken->department_id = $min['department_id'];
                $oldToken->counter_id = $min['counter_id'];
                $oldToken->note       = (!empty($request->note)) ? $request->note : null;
                $oldToken->reason_for_visit = ($reason != null) ? $reason->reason : null;
                $oldToken->lat = (!empty($request->lat)) ? $request->lat : null;
                $oldToken->lng = (!empty($request->lng)) ? $request->lng : null;
                $oldToken->save();

                //store in database  
                //set message and redirect
                if ($request->id > 0) {
                    // //Insert token status                    
                    // $save = TokenStatus::insert([
                    //     'token_id'    => $insert_id,
                    //     'status'      => 3,
                    //     'time_stamp' => date('Y-m-d H:i:s')
                    // ]);

                    $token = null;
                    //retrive token info
                    $token = Token::select(
                        'token.*',
                        'department.name as department',
                        'counter.name as counter',
                        'user.firstname',
                        'user.lastname'
                    )
                        ->leftJoin('department', 'token.department_id', '=', 'department.id')
                        ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                        ->leftJoin('user', 'token.user_id', '=', 'user.id')
                        ->where('token.id', $request->id)
                        ->first();

                    DB::commit();

                    $list = Token::where('status', 0)
                        ->where('department_id', $oldToken->department_id)
                        ->where('counter_id', $oldToken->counter_id)
                        ->orderBy('id')->get();
                    $cntr = 1;
                    foreach ($list as $value) {
                        if ($value->token_no == $oldToken->token_no) {
                            break;
                        }
                        $cntr++;
                    }
                    $data['status'] = true;
                    $data['message'] = trans('app.token_generate_successfully');
                    $data['token']  = $token;
                    $data['position']  = $cntr;

                    activity('activity')
                        ->withProperties(['activity' => 'Client Token Transfer', 'department' => $token->department, 'token' => $token->token_no, 'display' => 'success', 'location_id' => auth()->user()->location_id])
                        ->log('Token (:properties.token) generated for :properties.department');
                } else {
                    $data['status'] = false;
                    $data['exception'] = trans('app.please_try_again');
                }



                return response()->json($data);
            }
        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json($err->getMessage());
        }
    }

    /*-----------------------------------
    | FORCE/MANUAL/VIP TOKEN 
    |-----------------------------------*/

    public function showForm()
    {
        $display = DisplaySetting::first();
        $counters = Counter::where('status', 1)->pluck('name', 'id');
        $departments = Department::where('status', 1)->pluck('name', 'id');
        $officers = User::select(DB::raw('CONCAT(firstname, " ", lastname) as name'), 'id')
            ->where('user_type', 1)
            ->where('status', 1)
            ->orderBy('firstname', 'ASC')
            ->pluck('name', 'id');

        return view('pages.token.manual', compact('display', 'counters', 'departments', 'officers'));
    }

    public function create(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $display = DisplaySetting::first();

        if ($display->sms_alert) {
            $validator = Validator::make($request->all(), [
                'client_mobile' => 'required',
                'department_id' => 'required|max:11',
                // 'counter_id'    => 'required|max:11',
                // 'user_id'       => 'required|max:11',
                'note'          => 'max:512',
                'is_vip'        => 'max:1'
            ])
                ->setAttributeNames(array(
                    'client_mobile' => trans('app.client_mobile'),
                    'department_id' => trans('app.department'),
                    // 'counter_id'    => trans('app.counter'),
                    // 'user_id'       => trans('app.officer'),
                    'note'          => trans('app.note'),
                    'is_vip'        => trans('app.is_vip'),
                ));
        } else {
            $validator = Validator::make($request->all(), [
                'department_id' => 'required|max:11',
                // 'counter_id'    => 'required|max:11',
                // 'user_id'       => 'required|max:11',
                'note'          => 'max:512',
                'is_vip'        => 'max:1'
            ])
                ->setAttributeNames(array(
                    'department_id' => trans('app.department'),
                    // 'counter_id'    => trans('app.counter'),
                    // 'user_id'       => trans('app.officer'),
                    'note'          => trans('app.note'),
                    'is_vip'        => trans('app.is_vip'),
                ));
        }

        if ($validator->fails()) {
            $data['status'] = false;
            $data['exception'] = "<ul class='list-unstyled'>";
            $messages = $validator->messages();
            foreach ($messages->all('<li>:message</li>') as $message) {
                $data['exception'] .= $message;
            }
            $data['exception'] .= "</ul>";
        } else {
            //find auto-setting
            $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                ->where('department_id', $request->department_id)
                ->groupBy('user_id')
                ->get();

            // echo '<pre>';
            // print_r($settings);
            // echo '<pre>';
            // die();
            //Get user by mobile number
            $clientuser = User::where('mobile', $request->client_mobile)->first();

            //if auto-setting are available
            if (!empty($settings)) {

                foreach ($settings as $setting) {
                    //compare each user in today
                    $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                        ->where('department_id', $setting->department_id)
                        ->where('counter_id', $setting->counter_id)
                        ->where('user_id', $setting->user_id)
                        ->where('status', 0)
                        ->whereRaw('DATE(created_at) = CURDATE()')
                        ->orderBy('total_tokens', 'asc')
                        ->groupBy('user_id')
                        ->first();

                    //create user counter list
                    $tokenAssignTo[] = [
                        'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                        'department_id' => $setting->department_id,
                        'counter_id'    => $setting->counter_id,
                        'user_id'       => $setting->user_id
                    ];
                }

                //findout min counter set to 
                $min = min($tokenAssignTo);
                $saveToken = [
                    'token_no'      => (new Token_lib)->newToken($min['department_id'], $min['counter_id'], $request->is_vip),
                    'client_mobile' => $request->client_mobile,
                    'department_id' => $min['department_id'],
                    'counter_id'    => $min['counter_id'],
                    'user_id'       => $min['user_id'],
                    'client_id'       => (!empty($clientuser) ? $clientuser->id : null),
                    'note'          => $request->note,
                    'is_vip'        => $request->is_vip,
                    'created_by'    => auth()->user()->id,
                    'location_id'    => auth()->user()->location_id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => null,
                    'status'        => 0
                ];
            }

            //-----------------------------------
            // $newTokenNo = (new Token_lib)->newToken($request->department_id, $request->counter_id, $request->is_vip);

            // $save = Token::insert([
            //     'token_no'      => $newTokenNo,
            //     'client_mobile' => $request->client_mobile,
            //     'department_id' => $request->department_id,
            //     'counter_id'    => $request->counter_id,
            //     'user_id'       => $request->user_id,
            //     'note'          => $request->note,
            //     'created_by'    => auth()->user()->id,
            //     'created_at'    => date('Y-m-d H:i:s'),
            //     'updated_at'    => null,
            //     'is_vip'        => $request->is_vip,
            //     'status'        => 0
            // ]);

            if ($insert_id = Token::insertGetId($saveToken)) {
                // if ($save) {
                $token = Token::select(
                    'token.*',
                    'department.name as department',
                    'counter.name as counter',
                    'user.firstname',
                    'user.lastname'
                )
                    ->leftJoin('department', 'token.department_id', '=', 'department.id')
                    ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                    ->leftJoin('user', 'token.user_id', '=', 'user.id')
                    ->whereDate('token.created_at', date("Y-m-d"))
                    ->where('token.id', $insert_id)
                    ->first();

                // echo '<pre>';
                // print_r($token->id);
                // echo '</pre>';
                // echo '<pre>';
                // print_r($newTokenNo);
                // echo '</pre>';
                // die();


                //Insert token status                    
                $save = TokenStatus::insert([
                    'token_id'    => $token->id,
                    'status'      => 0,
                    'time_stamp' => date('Y-m-d H:i:s')
                ]);

                $data['status'] = true;
                $data['message'] = trans('app.token_generate_successfully');
                $data['token']  = $token;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    /*-----------------------------------
    | TOKEN CURRENT / REPORT / PERFORMANCE
    |-----------------------------------*/

    public function _current()
    {
        @date_default_timezone_set(session('app.timezone'));
        $tokens = Token::where('status', '0')
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->get();

        $counters = Counter::where('status', 1)->pluck('name', 'id');
        $departments = Department::where('status', 1)->pluck('name', 'id');
        $officers = User::select(DB::raw('CONCAT(firstname, " ", lastname) as name'), 'id')
            ->where('user_type', 1)
            ->where('status', 1)
            ->orderBy('firstname', 'ASC')
            ->pluck('name', 'id');

        return view('pages.token.current', compact('counters', 'departments', 'officers', 'tokens'));
    }

    public function current(TokenDataTable $dataTable)
    {
        if (!auth()->user()->can('view token')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        // $location = auth()->user()->location_id;
        $waiting = Token::where('status', '0')->where('location_id', auth()->user()->location_id)->count();
        $counters = Counter::where('status', 1)->where('location_id', auth()->user()->location_id)->pluck('name', 'id');
        $officers = User::select('id', DB::raw('CONCAT(firstname, " ", lastname) as full_name'))
            ->where('user_type', 1)
            ->where('status', 1)
            ->where('location_id', auth()->user()->location_id)
            ->orderBy('full_name', 'ASC')
            ->pluck('full_name', 'id');

        $departments = TokenSetting::select(
            'department.id',
            'department.name',
            'department.description',
            'token_setting.department_id',
            'counter.name as countername',
            'token_setting.counter_id',
            'token_setting.user_id',
            DB::raw('CONCAT(user.firstname ," " ,user.lastname) AS officer')
        )
            ->join('department', 'department.id', '=', 'token_setting.department_id')
            ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
            ->join('user', 'user.id', '=', 'token_setting.user_id')
            ->join('locations', 'locations.id', '=', 'token_setting.location_id')
            ->where('token_setting.status', 1)
            ->where('token_setting.location_id', auth()->user()->location_id)
            ->groupBy('token_setting.user_id')
            ->orderBy('token_setting.department_id', 'ASC')
            ->get();


        return $dataTable->with('token_location_id', auth()->user()->location_id)->render('pages.token.current', compact('counters', 'departments', 'officers', 'waiting'));
    }

    public function currentOfficer()
    {
        if (!auth()->user()->can('view token')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        // $tokens = Token::where('status', '0')
        //     ->where('user_id', auth()->user()->id)
        //     ->orderBy('is_vip', 'DESC')
        //     ->orderBy('id', 'ASC')
        //     ->get();
        $tokens = auth()->user()->pendingtokens()->get();
        $history = [];
        $reasons = null;
        if (count($tokens) > 0) {
            $firsttoken = $tokens[0];
            $reasons = $firsttoken->counter->visitreasons->pluck('reason')->toArray();
            asort($reasons);

            $locationarray = $firsttoken->location->company->locations->pluck("id")->toArray();
            if ($firsttoken->client)
                $history = $firsttoken->client->clienttokenhistory->whereIn('location_id', $locationarray);
        }

        return view('pages.token.current-icons', compact('tokens', 'reasons', 'history'));
    }

    public function report(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));
        $counters = Counter::where('status', 1)->pluck('name', 'id');
        $departments = Department::where('status', 1)->pluck('name', 'id');
        $officers = User::select('id', DB::raw('CONCAT(firstname, " ", lastname) as full_name'))
            ->where('user_type', 1)
            ->where('status', 1)
            ->orderBy('full_name', 'ASC')
            ->pluck('full_name', 'id');

        return view('pages.token.report', compact('counters', 'departments', 'officers'));
    }

    public function reportData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'token_no',
            2 => 'department_id',
            3 => 'counter_id',
            4 => 'user_id',
            5 => 'client_mobile',
            6 => 'note',
            7 => 'status',
            8 => 'created_by',
            9 => 'created_at',
            10 => 'updated_at',
            11 => 'updated_at',
            12 => 'id',
        ];

        $totalData = Token::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $search = $request->input('search');

        if (empty($search)) {
            $tokens = Token::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $tokensProccess = Token::where(function ($query)  use ($search) {

                if (!empty($search['status'])) {
                    $query->where('status', '=', $search['status']);
                }
                if (!empty($search['counter'])) {
                    $query->where('counter_id', '=', $search['counter']);
                }
                if (!empty($search['department'])) {
                    $query->where('department_id', '=', $search['department']);
                }
                if (!empty($search['officer'])) {
                    $query->where('user_id', '=', $search['officer']);
                }

                if (!empty($search['start_date']) && !empty($search['end_date'])) {
                    $query->whereBetween("created_at", [
                        date('Y-m-d', strtotime($search['start_date'])) . " 00:00:00",
                        date('Y-m-d', strtotime($search['end_date'])) . " 23:59:59"
                    ]);
                }

                if (!empty($search['value'])) {

                    if ((strtolower($search['value'])) == 'vip') {
                        $query->where('is_vip', '1');
                    } else {
                        $date = date('Y-m-d', strtotime($search['value']));
                        $query->where('token_no', 'LIKE', "%{$search['value']}%")
                            ->orWhere('client_mobile', 'LIKE', "%{$search['value']}%")
                            ->orWhere('note', 'LIKE', "%{$search['value']}%")
                            ->orWhere(function ($query)  use ($date) {
                                $query->whereDate('created_at', 'LIKE', "%{$date}%");
                            })
                            ->orWhere(function ($query)  use ($date) {
                                $query->whereDate('updated_at', 'LIKE', "%{$date}%");
                            })
                            ->orWhereHas('generated_by', function ($query) use ($search) {
                                $query->where(DB::raw('CONCAT(firstname, " ", lastname)'), 'LIKE', "%{$search['value']}%");
                            });
                    }
                }
            });

            $totalFiltered = $tokensProccess->count();
            $tokens = $tokensProccess->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        $data = array();
        if (!empty($tokens)) {
            $loop = 1;
            foreach ($tokens as $token) {
                # complete time calculation
                $complete_time = "";
                if (!empty($token->updated_at)) {
                    $date1 = new \DateTime($token->created_at);
                    $date2 = new \DateTime($token->updated_at);
                    $diff  = $date2->diff($date1);
                    $complete_time = (($diff->d > 0) ? " $diff->d Days " : null) . "$diff->h hrs $diff->i mins ";
                }

                //load options via render
                $options = view('pages.token._report-menu', compact('token'))->render();

                switch ($token->status) {
                    case 0:
                        $color  = 'badge-light-primary';
                        $bg     = 'bg-primary';
                        $txt    = trans('app.pending');
                        break;
                    case 1:
                        $color = 'badge-light-success';
                        $bg     = 'bg-success';
                        $txt    = trans('app.complete');
                        break;
                    case 2:
                        $color = 'badge-light-danger';
                        $bg     = 'bg-danger';
                        $txt    = trans('app.stop');
                        break;
                    case 3:
                        $color = 'badge-light-warning';
                        $bg     = 'bg-warning';
                        $txt    = 'Booked';
                        break;
                    default:
                        $color = 'badge-light-danger';

                        break;
                }

                $color = (!empty($token->is_vip)) ? 'bg-danger' : $color;

                $data[] = [
                    'serial'     => $loop++,
                    'token_no'   => "<div class=\"badge $color fw-bolder\" data-vip=\"$token->is_vip\" data-id=\"$token->token_no\">$token->token_no</div>" . '<input type=hidden name=notes value=' . $token->note . '><input type=hidden name=off_notes value=' . $token->officer_note . '>',
                    'department' => (!empty($token->department) ? $token->department->name : null),
                    'counter'    => (!empty($token->counter) ? $token->counter->name : null),
                    'officer'    => (!empty($token->officer) ? ("<a href='" . url("user/view/{$token->officer->id}") . "'>" . $token->officer->firstname . " " . $token->officer->lastname . "</a>") : null),

                    'client_mobile' => $token->client_mobile,

                    'note'          => $token->note,
                    'status'        => "<span class='badge " . $bg . " text-white'>" . $txt . "</span>",
                    'created_by'    => (!empty($token->generated_by) ? ("<a href='" . url("user/view/{$token->generated_by->id}") . "'>" . $token->generated_by->firstname . " " . $token->generated_by->lastname . "</a>") : null),
                    'created_at'    => (!empty($token->created_at) ? date('j M Y h:i a', strtotime($token->created_at)) : null),
                    'updated_at'    => (!empty($token->updated_at) ? date('j M Y h:i a', strtotime($token->updated_at)) : null),
                    'complete_time' => $complete_time,
                    'options'       => $options,
                    'token_id'      => $token->id,
                    'department_id' => $token->department->id,
                    'counter_id'    => $token->counter->id,
                    'officer_id'    => (!empty($token->officer) ? $token->officer->id : 0),
                    'officer_note'  => $token->officer_note,

                ];
            }
        }

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ]);
    }

    public function performance(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $report = (object)array(
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date
        );

        //REPORT DATA PROCESSING...
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date   = date('Y-m-d', strtotime($request->end_date));

        $tokens = DB::select("
         SELECT 
            realToken.user_id AS uid,
          (SELECT CONCAT_WS(' ', firstname, lastname) FROM user WHERE id= realToken.user_id) as officer,
          (
            SELECT COUNT(id) 
            FROM token 
            WHERE 
                user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '" . $start_date . "' AND '" . $end_date . "')
          ) AS total,
          
          (
            SELECT COUNT(id) 
            FROM token 
            WHERE 
                status = 2 
                AND user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '" . $start_date . "' AND '" . $end_date . "')
          ) AS stoped,
          (
            SELECT COUNT(id) 
            FROM token 
            WHERE 
                status = 1 
                AND user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '" . $start_date . "' AND '" . $end_date . "')
          ) AS success,
          (
            SELECT COUNT(id)
            FROM token 
            WHERE 
                status = 0 
                AND user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '" . $start_date . "' AND '" . $end_date . "')
          ) AS pending
          FROM 
            token AS realToken
          GROUP BY user_id
        ");
        //ENDS OF REPORT DATA PROCESSING...

        return view('pages.token.performance', compact('report', 'tokens'));
    }


    /*-----------------------------------
    | VIEW / RECALL / COMPLETE / STOPED / DELETE 
    |-----------------------------------*/

    public function viewSingleToken(Request $request)
    {
        return Token::select('token.*', 'department.name as department', 'counter.name as counter', 'user.firstname', 'user.lastname', 'locations.name as location')
            ->leftJoin('locations', 'token.location_id', '=', 'locations.id')
            ->leftJoin('department', 'token.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
            ->leftJoin('user', 'token.user_id', '=', 'user.id')
            ->where('token.id', $request->id)
            ->first();
    }


    public function printToken(Request $request)
    {
        $info = Token::select('token.*', 'department.name as department', 'counter.name as counter', 'user.firstname', 'user.lastname', 'locations.name as location')
            ->leftJoin('locations', 'token.location_id', '=', 'locations.id')
            ->leftJoin('department', 'token.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
            ->leftJoin('user', 'token.user_id', '=', 'user.id')
            ->where('token.id', $request->id)
            ->first();

        $content = "<style type=\"text/css\">@media print {" .
            "html, body {display:block;margin:0!important; padding:0 !important;overflow:hidden;display:table;}" .
            ".receipt-token {width:100vw;height:100vw;text-align:center}" .
            ".receipt-token h4{margin:0;padding:0;font-size:7vw;line-height:7vw;text-align:center}" .
            ".receipt-token h1{margin:0;padding:0;font-size:15vw;line-height:20vw;text-align:center}" .
            ".receipt-token ul{margin:0;padding:0;font-size:7vw;line-height:8vw;text-align:center;list-style:none;}" .
            "}</style>";

        $app = Setting::first();

        $content .= "<div class=\"receipt-token\">";
        $content .= "<h4 style='margin:0;padding:0;font-size:7vw;line-height:7vw;text-align:center'>" . ((!$app) ? $app->title . " : " : "") . $info->location . "</h4>";
        $content .= "<h1 style='margin:0;padding:0;font-size:15vw;line-height:20vw;text-align:center'>" . $info->token_no . "</h1><br />";
        $content .= "<ul style='margin:0;padding:0;font-size:7vw;line-height:8vw;text-align:center;list-style:none;'>";
        $content .= "<li><strong>" . trans('app.department') . "</strong> " . $info->department . "</li>";
        $content .= "<li><strong>" . trans('app.counter') . "</strong> " . $info->counter . "</li>";
        $content .= "<li><strong>" . trans('app.officer') . "</strong> " . $info->firstname . ' ' . $info->lastname . "</li>";
        if ($info->note) {
            $content .= "<li><strong>" . trans('app.note') . "</strong> " . $info->note . "</li>";
        }
        $content .= "<li><strong>" . trans('app.date') . "</strong> " . $info->created_at . "</li>";
        $content .= "</ul>";
        $content .= "</div>";

        $display = DisplaySetting::where("location_id", auth()->user()->location_id)->first();
        // Browsershot::html($content)->savePdf('token-'. $info->token_no .'.pdf');
        // return PDF::loadHtml($content)->setOptions(["page-height" => config('app.token.page-height', 50), "page-width" => config('app.token.page-width', 60)])->inline('token-' . $info->token_no . '.pdf');
        //return PDF::loadHtml($content)->setOptions(config('app.token-print-settings'))->inline('token-' . $info->token_no . '.pdf');
        return PDF::loadHtml($content)->setPaper($display->paper_size, $display->paper_orientation)->inline('token-' . $info->token_no . '.pdf');
    }

    public function recall($id = null)
    {
        @date_default_timezone_set(session('app.timezone'));

        //send sms immediately
        $setting  = SmsSetting::first();
        $token = DB::table('token AS t')
            ->select(
                "t.token_no AS token",
                "t.client_id AS client",
                "t.client_mobile AS mobile",
                "d.name AS department",
                "c.name AS counter",
                DB::raw("CONCAT_WS(' ', u.firstname, u.lastname) AS officer"),
                "t.created_at AS date"
            )
            ->leftJoin('department AS d', 'd.id', '=', 't.department_id')
            ->leftJoin('counter AS c', 'c.id', '=', 't.counter_id')
            ->leftJoin('user AS u', 'u.id', '=', 't.user_id')
            ->where('t.id', $id)
            ->first();

        if (!empty($token->mobile)) {
            $response = (new SMS_lib)
                ->provider("$setting->provider")
                ->api_key("$setting->api_key")
                ->username("$setting->username")
                ->password("$setting->password")
                ->from("$setting->from")
                ->to($token->mobile)
                ->message($setting->recall_sms_template, array(
                    'TOKEN'  => $token->token,
                    'MOBILE' => $token->mobile,
                    'DEPARTMENT' => $token->department,
                    'COUNTER' => $token->counter,
                    'OFFICER' => $token->officer,
                    'DATE'   => $token->date
                ))
                ->response();
            $api = json_decode($response, true);

            //store sms information 
            $sms = new SmsHistory;
            $sms->from        = $setting->from;
            $sms->to          = $token->mobile;
            $sms->message     = $api['message'];
            $sms->response    = $response;
            $sms->created_at  = date('Y-m-d H:i:s');
            $sms->save();
        }

        activity('activity')
            ->withProperties(['activity' => 'Token recalled', 'department' => $token->department, 'token' => $token->token, 'display' => 'danger', 'location_id' => auth()->user()->location_id])
            ->log('Token (:properties.token) recalled for :properties.department');

        if (!empty($token->client)) {
            $user = User::find($token->client);
            $msg = "Please contact urgently. Token No: $token->token\r\n Department: $token->department, Counter: $token->counter and Officer: $token->officer. \r\n $token->date.";
            (new Utilities_lib)->sendPushNotification($user, $msg);
            (new Utilities_lib)->sendTokenNotification($user, $token->notification_type, $msg);
        }

        Token::where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status'     => 0,
                'sms_status' => 2
            ]);

        //Insert token status
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 0,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        //RECALL 
        return redirect()->back()->with('message', trans('app.recall_successfully'));
    }

    public function complete($id = null)
    {
        @date_default_timezone_set(session('app.timezone'));

        $token = Token::where('id', $id)->first();
        $token->updated_at = date('Y-m-d H:i:s');
        $token->status = 1;
        $token->sms_status = 1;
        if (!$token->started_at)
            $token->started_at = date('Y-m-d H:i:s');

        $token->update();

        // Token::where('id', $id)->update(['updated_at' => date('Y-m-d H:i:s'), 'status' => 1, 'sms_status' => 1]);
        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 1,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        $dept = $token->department->name;
        $officer = $token->officer->name;
        $counter = $token->counter->name;

        activity('activity')
            ->withProperties(['activity' => 'Token complete', 'department' => $dept, 'token' => $token->token_no, 'display' => 'danger', 'location_id' => auth()->user()->location_id])
            ->log('Token (:properties.token) recalled for :properties.department');

        if (!empty($token->client_id)) {
            $user = User::find($token->client_id);
            $msg = "Token No: $token->token_no\r\n Department: $dept, Counter: $counter and Officer: $officer. \r\nComplete";
            (new Utilities_lib)->sendPushNotification($user, $msg);
            (new Utilities_lib)->sendTokenNotification($user, $token->notification_type, $msg);
        }
        // (new Utilities_lib)->TokenNotification();
        return redirect()->back()->with('message', trans('app.complete_successfully'));
    }

    public function stoped($id = null)
    {
        Token::where('id', $id)->update(['updated_at' => null, 'status' => 2, 'sms_status' => 1]);
        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 2,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        $token = Token::where('id', $id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Client Stopped Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'danger', 'location_id' => auth()->user()->location_id])
            ->log('Token (:properties.token) stopped for :properties.department');

        if (!empty($token->client_id)) {
            $dept = $token->department->name;
            $officer = $token->officer->name;
            $counter = $token->counter->name;
            $user = User::find($token->client_id);
            $msg = "Token No: $token->token_no\r\n Department: $dept, Counter: $counter and Officer: $officer. \r\Stopped";
            (new Utilities_lib)->sendPushNotification($user, $msg);
            (new Utilities_lib)->sendTokenNotification($user, $token->notification_type, $msg);
        }
        // (new Utilities_lib)->TokenNotification();
        return redirect()->back()->with('message', trans('app.update_successfully'));
    }

    public function noshow($id = null)
    {
        @date_default_timezone_set(session('app.timezone'));

        Token::where('id', $id)->update(['updated_at' => date('Y-m-d H:i:s'), 'status' => 2, 'sms_status' => 1, 'no_show' => 1]);
        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 2,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        $token = Token::where('id', $id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Staff Cancelled Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'danger', 'location_id' => auth()->user()->location_id])
            ->log('Token (:properties.token) cancelled for :properties.department');

        if (!empty($token->client_id)) {
            $user = User::find($token->client_id);
            $dept = $token->department->name;
            // $officer = $token->officer->name;
            // $counter = $token->counter->name;

            $msg = "Token No: $token->token_no\r\n Department: $dept\r\ncancelled due to no show.";
            (new Utilities_lib)->sendPushNotification($user, $msg);
            (new Utilities_lib)->sendTokenNotification($user, $token->notification_type, $msg);
        }
        // (new Utilities_lib)->TokenNotification();
        return redirect()->back()->with('message', trans('app.update_successfully'));
    }

    public function start($id = null)
    {
        @date_default_timezone_set(session('app.timezone'));

        Token::where('id', $id)->update(['started_at' => date('Y-m-d H:i:s'), 'status' => 0]);
        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 0,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);
        $token = Token::where('id', $id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Now Serving Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'info', 'location_id' => auth()->user()->location_id])
            ->log('Token (:properties.token) started for :properties.department');


        if (!empty($token->client_id)) {
            $user = User::find($token->client_id);
            $dept = $token->department->name;
            $officer = $token->officer->name;
            $counter = $token->counter->name;
            $msg = "Now serving token No: $token->token_no\r\n Department: $dept, Counter: $counter and Officer: $officer.";
            (new Utilities_lib)->sendPushNotification($user, $msg);
            (new Utilities_lib)->sendTokenNotification($user, $token->notification_type, $msg);
        }
        // (new Utilities_lib)->TokenNotification();
        return redirect()->back()->with('message', trans('app.update_successfully'));
    }

    public function transfer(Request $request)
    {
        // transfer token
        $validator = Validator::make($request->all(), [
            'id'            => 'required|max:11',
            'department_id' => 'required|max:11',
            'counter_id'    => 'required|max:11',
            'user_id'       => 'required|max:11'
        ])
            ->setAttributeNames(array(
                'id'            => trans('app.token'),
                'department_id' => trans('app.department'),
                'counter_id'    => trans('app.counter'),
                'user_id'       => trans('app.officer')
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['exception'] = "<ul class='list-unstyled'>";
            $messages = $validator->messages();
            foreach ($messages->all('<li>:message</li>') as $message) {
                $data['exception'] .= $message;
            }
            $data['exception'] .= "</ul>";
        } else {
            $update = Token::where('id', $request->id)
                ->update([
                    'department_id' => $request->department_id,
                    'counter_id'    => $request->counter_id,
                    'user_id'       => $request->user_id,
                    'is_vip'        => $request->is_vip,
                    'officer_note'  => $request->officer_note,
                ]);

            $token = Token::find($request->id);
            if (!empty($token->client_id)) {
                $dept = $token->department->name;
                $officer = $token->officer->name;
                $counter = $token->counter->name;

                $user = User::find($token->client_id);
                $msg = "Token transferred\r\nToken No: $token->token_no\r\n Department: $dept, Counter: $counter and Officer: $officer.";
                (new Utilities_lib)->sendPushNotification($user, $msg);
                (new Utilities_lib)->sendTokenNotification($user, $token->notification_type, $msg);
            }

            if ($update) {
                $data['status'] = true;
                $data['message'] = trans('app.token_transfered_successfully');
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        // (new Utilities_lib)->TokenNotification();
        return response()->json($data);
    }

    public function clientTransfer($id)
    {
        $display = DisplaySetting::first();

        $smsalert = $display->sms_alert;
        $shownote = $display->show_note;

        $token = Token::find($id);


        $company = $token->location->company;
        // if ($company == null) {

        //     $companies = Company::where('active', true)->whereRelation('locations', 'active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
        //     $categories = BusinessCategory::whereRelation('locations', 'locations.active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
        //     Session::flash("fail", trans('app.company_not_found'));
        //     return view('pages.home.advsearch', compact('smsalert', 'maskedemail', 'shownote', 'companies', 'categories'));
        // }
        $locations = $token->location->company->locations->except([$token->location_id]);
        // echo '<pre>';
        // print_r($token);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($locations);
        // echo '</pre>';
        // die();
        // Location::where('company_id', $company->id)->where('active', 1)->has('departments')->with('settings')->whereRelation("company", "active", true)->get();
        return view('pages.home.transfer', compact('locations', 'company', 'token'));

        die();
        @date_default_timezone_set(session('app.timezone'));
        $token = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->where('id', $id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();


        if (!$token) {
            return redirect('home');
        }

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', [0, 3])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        // $waittime = $dept->avg_wait_time * ($cntr - 1);
        $waittime = $token->officer->service_time * ($cntr - 1);

        $position = $cntr;
        $wait = date('H:i', mktime(0, $waittime));

        //  echo '<pre>';
        // print_r($wait);
        // // echo session('app.timezone');
        // echo '</pre>';
        // die();

        // $tokenstatus = TokenStatus::where('token_id', $token->id)->first();
        $display = DisplaySetting::where('location_id', $token->location_id)->first();
        $qrcheckin = $display->enable_qr_checkin;
        // echo '<pre>';
        // // print_r($token->startTime);
        // echo session('app.timezone');
        // echo '</pre>';
        // die();

        return view('pages.home.transfer', compact('token', 'position', 'wait', 'qrcheckin'));
    }

    public function delete($id = null)
    {
        Token::where('id', $id)->delete();
        return redirect()->back()->with('message', trans('app.delete_successfully'));
    }

    public function addnote(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $update = Token::where('id', $request->id)
            ->update([
                'officer_note'  => $request->officer_note,
            ]);
        if ($update) {
            $data['status'] = true;
            $data['message'] = trans('app.note_added_successfully');
        } else {
            $data['status'] = false;
            $data['exception'] = trans('app.please_try_again');
        }

        return response()->json($data);
    }

    public function addreasonforvisit(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $update = Token::where('id', $request->id)
            ->update([
                'reason_for_visit'  => $request->reason_for_visit,
            ]);
        if ($update) {
            $data['status'] = true;
            $data['message'] = trans('app.added_successfully');
        } else {
            $data['status'] = false;
            $data['exception'] = trans('app.please_try_again');
        }

        return response()->json($data);
    }


    /*-----------------------------------
    | TOKEN CURRENT / REPORT / PERFORMANCE
    |-----------------------------------*/

    public function _currentClient()
    {
        @date_default_timezone_set(session('app.timezone'));
        $token = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();


        if (!$token) {
            return redirect('home');
        }

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', [0, 3])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        $waittime = $dept->avg_wait_time * ($cntr - 1);

        $position = $cntr;
        $wait = date('H:i', mktime(0, $waittime));

        //  echo '<pre>';
        // print_r($wait);
        // // echo session('app.timezone');
        // echo '</pre>';
        // die();

        $tokenstatus = TokenStatus::where('token_id', $token->id)->first();
        $display = DisplaySetting::where('location_id', $token->location_id)->first();
        $qrcheckin = $display->enable_qr_checkin;
        // echo '<pre>';
        // // print_r($token->startTime);
        // echo session('app.timezone');
        // echo '</pre>';
        // die();

        return view('pages.home.current', compact('token', 'position', 'wait', 'qrcheckin'));
    }

    public function currentClient($id)
    {
        @date_default_timezone_set(session('app.timezone'));
        $token = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->where('id', $id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();


        if (!$token) {
            return redirect('home');
        }

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', [0, 3])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        // $waittime = $dept->avg_wait_time * ($cntr - 1);
        $waittime = $token->officer->service_time * ($cntr - 1);

        $position = $cntr;
        $wait = date('H:i', mktime(0, $waittime));

        $display = DisplaySetting::where('location_id', $token->location_id)->first();
        $qrcheckin = $display->enable_qr_checkin;

        return view('pages.home.current', compact('token', 'position', 'wait', 'qrcheckin'));
    }
    public function currentClientList()
    {
        @date_default_timezone_set(session('app.timezone'));

        if (count(auth()->user()->clientpendingtokens) == 0) {
            return redirect('home');
        } else if (count(auth()->user()->clientpendingtokens) == 1) {
            $only = auth()->user()->clientpendingtokens[0];
            return redirect('home/current/' . $only->id);
        }

        return view('pages.home.list');
    }

    public function defaultClientSearch()
    {
        @date_default_timezone_set(session('app.timezone'));
        $display = DisplaySetting::first();

        $smsalert = $display->sms_alert;
        $shownote = $display->show_note;

        $maskedemail = auth()->user()->getMaskedEmail();
        
        $companies = Company::where('active', true)->whereRelation('locations', 'active', true)->has('locations.departments')->orderBy('name', 'asc')->get();

        return view('pages.home.index', compact('smsalert', 'maskedemail', 'shownote', 'companies'));
    }

    public function advClientSearch()
    {
        @date_default_timezone_set(session('app.timezone'));
        $display = DisplaySetting::first();

        $smsalert = $display->sms_alert;
        $shownote = $display->show_note;

        $maskedemail = auth()->user()->getMaskedEmail();

        
        $categories = BusinessCategory::whereRelation('companies', 'company.active', true)->whereRelation('locations', 'locations.active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
        $companies = Company::where('active', true)->whereRelation('locations', 'active', true)->has('locations.departments')->orderBy('name', 'asc')->get();

        return view('pages.home.advsearch', compact('smsalert', 'maskedemail', 'shownote', 'companies', 'categories'));
    }

    public function businessSearch($id = null)
    {
        @date_default_timezone_set(session('app.timezone'));
        $display = DisplaySetting::first();

        $smsalert = $display->sms_alert;
        $shownote = $display->show_note;

        $maskedemail = auth()->user()->getMaskedEmail();

        if ($id == null) {

            $companies = Company::where('active', true)->whereRelation('locations', 'active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
            $categories = BusinessCategory::whereRelation('locations', 'locations.active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
            return view('pages.home.advsearch', compact('smsalert', 'maskedemail', 'shownote', 'companies', 'categories'));
        } else {
            $company = Company::where('shortname', $id)->first();
            if ($company == null) {

                $companies = Company::where('active', true)->whereRelation('locations', 'active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
                $categories = BusinessCategory::whereRelation('locations', 'locations.active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
                Session::flash("fail", trans('app.company_not_found'));
                return view('pages.home.advsearch', compact('smsalert', 'maskedemail', 'shownote', 'companies', 'categories'));
            }
            $locations = Location::where('company_id', $company->id)->where('active', 1)->has('departments')->with('settings')->whereRelation("company", "active", true)->get();
            $filteredLocations = collect();

            foreach ($locations as $location) {
                $blocked = auth()->user()->isBlockedAtLocation($location->id);

                if (!$blocked) {
                    $location->is_vip = (auth()->user()->isVipAtLocation($location->id)) ? 1 : 0;
                    $location->blocked = false;
                    $filteredLocations->push($location);
                }
            }

            $locations = $filteredLocations;

            if($locations->count() == 0){
                $companies = Company::where('active', true)->whereRelation('locations', 'active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
                $categories = BusinessCategory::whereRelation('locations', 'locations.active', true)->has('locations.departments')->orderBy('name', 'asc')->get();
                Session::flash("fail", trans('app.no_location_found'));
                return view('pages.home.advsearch', compact('smsalert', 'maskedemail', 'shownote', 'companies', 'categories'));
            }else if($locations->count() == 1){
                return view('pages.home.smallbusiness', compact('smsalert', 'maskedemail', 'shownote', 'company', 'locations'));
            }else{
                return view('pages.home.business', compact('smsalert', 'maskedemail', 'shownote', 'company', 'locations'));
            }


            // return view('pages.home.business', compact('smsalert', 'maskedemail', 'shownote', 'company', 'locations'));
        }
    }

    public function _currentposition()
    {
        $token = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', ['0', '3'])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        $waittime = $dept->avg_wait_time * ($cntr);
        $data['status'] = true;
        $data['position'] = $cntr;
        $data['wait'] = date('H:i', mktime(0, $waittime));

        return response()->json($data);
    }

    public function currentposition($id)
    {
        $token = Token::where('id', $id)->first();

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', ['0', '3'])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        $waittime = $dept->avg_wait_time * ($cntr - 1);
        $data['status'] = true;
        $data['position'] = $cntr;
        $data['wait'] = date('H:i', mktime(0, $waittime));

        return response()->json($data);
    }

    public function getCurrentClientTokens()
    {
        $rawtokens = auth()->user()->clientpendingtokens;
        $tokens = array();
        foreach ($rawtokens as $value) {
            $obj = [
                "status" => $value->status,
                "logo" => $value->location->company->logo_url,
                "locationname" => $value->location->name,
                "address" => $value->location->address,
                "date" => Carbon::parse($value->created_at)->format('D M d Y h:i a'),
                "id" => $value->id,
                "lat" => $value->location->lat,
                "lng" => $value->location->lon,
            ];
            array_push($tokens, $obj);
        }

        $data['tokens'] = $tokens;
        $locationIds = array_column($rawtokens->toArray(), 'location_id');

        $locations = Location::whereIn('id', $locationIds)->get();
        $data['locations'] = $locations;

        $tokenids = array_column($rawtokens->toArray(), 'id');
        $key = implode("-", $tokenids);

        $data['key'] = $key;
        // Cache::forget($key);
        if (Cache::has($key)) {
            $data['routes'] = Cache::get($key);
        } else {
            $data['routes'] = "";
        }
        // $data['haskey'] = Cache::has($key);
        // Cache::forget($key);
        // echo "<pre>";
        // print_r(Cache::get($key));
        // echo "</pre>";
        // die();
        return response()->json($data);
    }

    public function computeRoute2(Request $request)
    {
        $tokens = auth()->user()->clientpendingtokens;
        $locationIds = array_column($tokens->toArray(), 'location_id');
        $tokenids = array_column($tokens->toArray(), 'id');
        $key = implode("-", $tokenids);
        // Cache::forget($key);
        $data['key'] = $key;
        if (!Cache::has($key)) {
            $locations = Location::whereIn('id', $locationIds)->get();
            $removeids = [];
            $data['start'] = $request->start_point;
            $data['end'] = $request->end_point;
            //Set start location
            if ($request->start_point == "-1") {
                $origin = array(
                    "location" => array(
                        "latLng" => array(
                            "latitude" => $request->lat,
                            "longitude" => $request->lng
                        )
                    )
                );
            } else {
                $loc = $locations->where('id', $request->start_point)->first();
                $origin = array(
                    "location" => array(
                        "latLng" => array(
                            "latitude" => $loc->lat,
                            "longitude" => $loc->lon
                        )
                    )
                );

                array_push($removeids, $request->start_point);
            }

            //Set end location
            if ($request->end_point == "-1") {
                $destination = array(
                    "location" => array(
                        "latLng" => array(
                            "latitude" => $request->lat,
                            "longitude" => $request->lng
                        )
                    )
                );
            } else {
                $loc = $locations->where('id', $request->end_point)->first();
                $destination = array(
                    "location" => array(
                        "latLng" => array(
                            "latitude" => $loc->lat,
                            "longitude" => $loc->lon
                        )
                    )
                );
                array_push($removeids, $request->end_point);
            }

            //Set waypoints
            $filteredlocations = $locations->whereNotIn('id', $removeids);
            $intermediates = [];
            foreach ($filteredlocations as $value) {
                $tmp = array(
                    "location" => array(
                        "latLng" => array(
                            "latitude" => $value->lat,
                            "longitude" => $value->lon
                        )
                    )
                );

                array_push($intermediates, $tmp);
            }

            //format object
            $jsonObject = array(
                "origin" => $origin,
                "destination" => $destination,
                "intermediates" => array(
                    $intermediates
                ),
                "travelMode" => "DRIVE",
                "routingPreference" => "TRAFFIC_AWARE",
                // "polylineQuality" => "enum (PolylineQuality)",
                // "polylineEncoding" => "enum (PolylineEncoding)",
                // "departureTime" => "string",
                "computeAlternativeRoutes" => false,
                "routeModifiers" => array(
                    "avoidTolls" => false,
                    "avoidHighways" => false,
                    "avoidFerries" => false,
                ),
                "languageCode" => "en-US",
                "units" => "IMPERIAL",
                // "requestedReferenceRoutes" => array(
                //     "enum (ReferenceRoute)"
                // )
            );

            // echo '<pre>';
            // print_r($jsonObject);
            // echo '</pre>';
            // die();

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => env('GOOGLE_MAP_API'),
                'X-Goog-FieldMask' => 'routes.duration,routes.distanceMeters,routes.legs'
            ])->post('https://routes.googleapis.com/directions/v2:computeRoutes', $jsonObject);

            $data['routes'] = $response->object();
            Cache::put($key, $data, now()->addHours(12));
            return response()->json($data);
        } else {

            $cacheval = Cache::get($key);
            return response()->json($cacheval);
        }
    }

    public function computeRoute(Request $request)
    {
        $tokens = auth()->user()->clientpendingtokens;
        $tokenids = array_column($tokens->toArray(), 'id');
        $key = implode("-", $tokenids);

        Cache::put($key, $request->route, now()->addHours(12));
        return response()->json($request->route);
    }

    public function checkin($id = null)
    {
        Token::where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status'     => 0,
                'sms_status' => 1
            ]);

        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 0,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        $data['status'] = true;
        $data['exception'] = trans('app.update_successfully');

        $token = Token::where('id', $id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Client Checked In Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'primary', 'location_id' => auth()->user()->location_id])
            ->log('Token :properties.token checked in for :properties.department');

        return response()->json($data);
    }

    public function otpcheckin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'        => 'required|max:50',
            'code'      => 'max:4'
        ])
            ->setAttributeNames(array(
                'id' => trans('app.name'),
                'code' => trans('app.code')
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data, 422);
        }

        $token = Token::where('id', $request->id)->first();
        if (!$token) {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data);
        }
        // $location_id = auth()->user()->location_id;
        $setting = DisplaySetting::where('location_id', $token->location_id)->first();
        //  $appSetting = Setting::first();   
        @date_default_timezone_set(session('app.timezone') ? session('app.timezone') : $setting->timezone);
        // echo '<pre>';        
        // // print_r($code);
        // echo session('app.timezone');
        // echo '</pre>';
        // echo '<pre>';        
        // // print_r($code);
        // echo $setting->timezone;
        // echo '</pre>';
        // die();

        $newDateTime = Carbon::now(session('app.timezone'))->subMinutes(5);
        $location_id = $token->location_id;
        $otpcode = $request->code;
        //  echo '<pre>';        
        // // print_r($request);
        // echo $otpcode;
        // echo '</pre>';
        // die();

        if ($otpcode == substr(auth()->user()->otp, 0, 4)) {
            goto bypass;
        }

        $code = CheckInCodes::where("created_at", ">", $newDateTime->format('Y-m-d H:i'))->where('location_id', $location_id)->where('code', $otpcode)->first();

        if (!$code) {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data);
        }

        bypass:

        Token::where('id', $request->id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status'     => 0,
                'sms_status' => 1
            ]);

        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $request->id,
            'status'      => 0,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        $data['status'] = true;
        $data['exception'] = trans('app.update_successfully');

        $token = Token::where('id', $request->id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Client Checked In Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'primary', 'location_id' => auth()->user()->location_id])
            ->log('Token :properties.token checked in for :properties.department');

        return response()->json($data);
    }

    public function qrcheckin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'location'        => 'required',
            'tokenid'      => 'required'
        ])
            ->setAttributeNames(array(
                'location' => trans('app.location'),
                'tokenid' => trans('app.token')
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data, 422);
        }

        $location_id = Crypt::decrypt($request->location);

        $token = Token::where('id', $request->tokenid)->where('location_id', $location_id)->first();
        if (!$token) {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data);
        }

        Token::where('id', $request->tokenid)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status'     => 0,
                'sms_status' => 1
            ]);

        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $request->tokenid,
            'status'      => 0,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        $data['status'] = true;
        $data['exception'] = trans('app.update_successfully');

        // $token = Token::where('id', $request->id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Client Checked In Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'primary', 'location_id' => auth()->user()->location_id])
            ->log('Token :properties.token checked in for :properties.department');

        return response()->json($data);
    }


    public function stopedClient($id)
    {
        Token::where('id', $id)
            ->where('client_id', auth()->user()->id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status'     => 2,
                'sms_status' => 1
            ]);

        //Insert token status                    
        $save = TokenStatus::insert([
            'token_id'    => $id,
            'status'      => 2,
            'time_stamp' => date('Y-m-d H:i:s')
        ]);

        // $token = Token::where('id', $id)->get();

        $data['status'] = true;
        $data['exception'] = trans('app.update_successfully');

        $token = Token::where('id', $id)->first();
        activity('activity')
            ->withProperties(['activity' => 'Client Stopped Token', 'department' => $token->department->name, 'token' => $token->token_no, 'display' => 'danger', 'location_id' => auth()->user()->location_id])
            ->log('Token (:properties.token) stopped for :properties.department');

        return response()->json($data);
    }
}
