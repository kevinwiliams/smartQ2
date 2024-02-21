<?php

namespace App\Http\Controllers\Admin;

use App\Core\Constants;
use App\Core\Data;
use App\DataTables\Counter\CounterDataTable;
use App\DataTables\Department\DepartmentDataTable;
use App\DataTables\Services\ServicesDataTable;
use App\DataTables\VisitReason\VisitReasonDataTable;
use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\BusinessHours;
use App\Models\Company;
use App\Models\Counter;
use App\Models\Department;
use App\Models\DisplaySetting;
use App\Models\Invitation;
use App\Models\Location;
use App\Models\Role;
use App\Models\Setting;
use App\Models\TokenSetting;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class OnboardingController extends Controller
{
    public function start()
    {

        $key_value = auth()->user()->getSettingByKey(Constants::User_Settings_Onboarding);

        if ($key_value != null) {
            $this->setUserRole();
            // $key_value = 1;
            // auth()->user()->setSetting(Constants::User_Settings_Onboarding, $key_value);
        }

        $url = $this->next_url(false);
        // echo $url;
        // die();
        return redirect($url);
    }

    public function next_url($increment = true)
    {

        $key_value = auth()->user()->getSettingByKey(Constants::User_Settings_Onboarding);

        if ($key_value == null) {
            $key_value = 0;
        } else {
            if ($increment)
                $key_value += 1;
        }

        if ($increment)
            auth()->user()->setSetting(Constants::User_Settings_Onboarding, $key_value);

        $returnVal = "";
        switch ($key_value) {
            case 1:
                $returnVal = "/onboarding/business";
                break;
            case 2:
                $returnVal = "/onboarding/location";
                break;
            case 3:
                $returnVal = "/onboarding/openhours";
                break;
            case 4:
                $returnVal = "/onboarding/services";
                break;
            case 5:
                $returnVal = "/onboarding/departments";
                break;
            case 6:
                $returnVal = "/onboarding/counters";
                break;
            case 7:
                $returnVal = "/onboarding/staff";
                break;
            case 8:
                $returnVal = "/onboarding/queuesetup";
                break;
                // case 9:
                //     $returnVal = "/onboarding/visitreasons";
                //     break;
                // case 10:
                //     $returnVal = "/onboarding/countervisitreason";
                //     break;
            case 9:
                $returnVal = "/onboarding/complete";
                break;
            default:
                $returnVal = "/home";
                break;
        }

        if (request()->ajax() || request()->wantsJson()) {
            $data['status'] = false;
            $data['data'] = $returnVal;
            return response()->json($data);
        } else {
            return $returnVal;
        }
    }

    public function previous_url()
    {
        $key_value = auth()->user()->getSettingByKey(Constants::User_Settings_Onboarding);

        if ($key_value == null) {
            $key_value = 1;
        } else {
            $key_value -= 1;
        }
        auth()->user()->setSetting(Constants::User_Settings_Onboarding, $key_value);
        return $this->next_url(false);
    }

    public function cancel()
    {
        $delete = UserSetting::where('key', Constants::User_Settings_Onboarding)->where('user_id', auth()->user()->id)->delete();
        $this->setUserRole(false);

        if ($delete) {
            $data['status'] = true;
            $data['message'] = trans('app.cancelled_successfully');
            return response()->json($data);
        } else {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
            return response()->json($data, 400);
        }
    }

    private function keyCheck(&$key_value)
    {
        $key_value = auth()->user()->getSettingByKey(Constants::User_Settings_Onboarding);

        if ($key_value == null) {
            return $this->start();
        }
    }

    public function business()
    {

        $key_value = null;
        $this->keyCheck($key_value);

        $categories = BusinessCategory::get();
        $company = Company::where('created_by', auth()->user()->id)->first();

        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        return view('pages.onboarding.business', compact('categories', 'company', 'step_total_count', 'step_current'));
    }

    public function createCompany(Request $request)
    {
        // if (!auth()->user()->can('create company')) {
        //     return Redirect::to("/")->withFail(trans('app.no_permissions'));
        // }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:company,name,' . $request->id, // Assuming $companyId is the ID of the current record
            'shortname' => 'nullable|max:50|unique:company,shortname,' . $request->id,

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
                'active' => trans('app.active'),
                'business_category_id' => trans('app.category_id'),
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

            if (!$request->has('id')) {

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
                    'business_category_id' => $request->business_category_id,
                    'shortname' => $request->shortname,
                    'created_by' => auth()->user()->id
                ]);
            } else {
                $company = Company::where('id', $request->id)
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
            }

            if ($company) {
                ///Generate: default location
                if (!$request->has('id')) {
                    $location = Location::create([
                        'company_id' => $company->id,
                        'name'  => $request->name,
                        'address' =>  $request->address,
                        'lat' => 0,
                        'lon' => 0,
                        'active' => ($request->has('active')) ? 1 : 0
                    ]);

                    ///Generate: default display settings
                    $displaysettings = Data::getDefaultDisplay();
                    $displaysettings['location_id'] = $location->id;
                    $display = DisplaySetting::insert($displaysettings);

                    $user = User::find(auth()->user()->id);
                    $user->location_id = $location->id;
                    $user->save();
                } else {
                    $location = Location::where('id', $request->id)
                        ->update([
                            'company_id' => $request->id,
                            'name'  => $request->name,
                            'address' =>  $request->address,
                            'lat' => 0,
                            'lon' => 0,
                            'active' => ($request->has('active')) ? 1 : 0
                        ]);
                }

                $nextURL = $this->next_url();

                $data['status'] = true;
                $data['data'] = $nextURL;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }

    public function location()
    {

        $key_value = null;
        $this->keyCheck($key_value);

        $categories = BusinessCategory::get();
        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        return view('pages.onboarding.location', compact('location', 'step_total_count', 'step_current'));
    }

    public function editLocation(Request $request, $id)
    {

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:50',
            'address'      => 'required',
            'company_id'      => 'required',
            'lat'      => 'required',
            'lon'      => 'required'
        ])
            ->setAttributeNames(array(
                'company_id' => trans('app.company'),
                'name' => trans('app.name'),
                'address' => trans('app.address'),
                'lat' => trans('app.lat'),
                'lon' => trans('app.lng'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {
            $update = Location::where('id', $id)
                ->update([
                    'company_id' => $request->company_id,
                    'name'  => $request->name,
                    'address' =>  $request->address,
                    'lat' => $request->lat,
                    'lon' => $request->lon,
                    'active' => ($request->has('active')) ? 1 : 0
                ]);

            $nextURL = $this->next_url();

            if ($update) {
                $data['status'] = true;
                $data['data'] = $nextURL;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }

    public function openhours()
    {

        $key_value = null;
        $this->keyCheck($key_value);

        $company = Company::where('created_by', auth()->user()->id)->first();
        $location = $company->locations->first();
        $location_id = $location->id;
        $hours = BusinessHours::where('location_id', $location->id)->get();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        return view('pages.onboarding.openhours', compact('hours', 'location_id', 'step_total_count', 'step_current'));
    }

    public function editOpenhours(Request $request, $id)
    {
        @date_default_timezone_set(session('app.timezone'));

        $days = [
            1 => ['is_open' => $request->is_open_1, 'start_time' => $request->start_time_1, 'end_time' => $request->end_time_1],
            2 => ['is_open' => $request->is_open_2, 'start_time' => $request->start_time_2, 'end_time' => $request->end_time_2],
            3 => ['is_open' => $request->is_open_3, 'start_time' => $request->start_time_3, 'end_time' => $request->end_time_3],
            4 => ['is_open' => $request->is_open_4, 'start_time' => $request->start_time_4, 'end_time' => $request->end_time_4],
            5 => ['is_open' => $request->is_open_5, 'start_time' => $request->start_time_5, 'end_time' => $request->end_time_5],
            6 => ['is_open' => $request->is_open_6, 'start_time' => $request->start_time_6, 'end_time' => $request->end_time_6],
            0 => ['is_open' => $request->is_open_0, 'start_time' => $request->start_time_0, 'end_time' => $request->end_time_0]
        ];

        $businessHours = BusinessHours::where('location_id', $id)->get()->keyBy('day');

        foreach ($days as $day => $data) {
            $isOpen = $data['is_open'];
            $_start = '';
            $_end = '';

            switch ($isOpen) {
                case 'all':
                    $_start = '00:00';
                    $_end = '24:00';
                    break;
                case 'true':
                    $_start = $data['start_time'];
                    $_end = $data['end_time'];
                    break;
                case 'false':
                    $_start = '00:00';
                    $_end = '00:00';
                    break;
            }

            $businessHour = $businessHours->get($day);

            if ($businessHour) {
                $businessHour->update([
                    'start_time' => $_start,
                    'end_time' => $_end,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                BusinessHours::create([
                    'location_id' => $id,
                    'day' => $day,
                    'start_time' => $_start,
                    'end_time' => $_end,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        $updatedBusinessHours = BusinessHours::where('location_id', $id)->get();

        $nextURL = $this->next_url();

        if ($updatedBusinessHours->count() > 0) {
            $data['status'] = true;
            $data['data'] = $nextURL;
            $data['message'] = trans('app.update_successfully');
        } else {
            $data['status'] = false;
            $data['message'] = trans('app.please_try_again');
        }

        return response()->json($data);
    }

    public function services(ServicesDataTable $dataTable)
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;

        return $dataTable->with('servlocation_id', $location->id)->render('pages.onboarding.services', compact('location', 'step_total_count', 'step_current'));
    }

    public function departments(DepartmentDataTable $dataTable)
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $keyList = $this->keyList();

        return $dataTable->with('deptlocation_id', $location->id)->render('pages.onboarding.departments', compact('keyList', 'location', 'step_total_count', 'step_current'));
    }


    public function counters(CounterDataTable $dataTable)
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $keyList = $this->keyList();

        return $dataTable->with('ctrlocation_id', $location->id)->render('pages.onboarding.counters', compact('location', 'step_total_count', 'step_current'));
    }


    public function visitreasons(VisitReasonDataTable $dataTable)
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $keyList = $this->keyList();
        $departmentlist = Department::where('location_id', $location->id)->orderBy('name')->pluck('name', 'id');

        return $dataTable->with('deptlocation_id', $location->id)->render('pages.onboarding.reasonforvisit', compact('location', 'departmentlist', 'step_total_count', 'step_current'));
    }

    public function visitreasoncounters()
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $id = $location->id;
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)->first();
        $info = TokenSetting::where('location_id', $id)->get();

        $data = collect();
        foreach ($info as  $value) {

            if (!$value->department || !$value->counter)
                continue;

            $tmp = collect();
            $tmp->department_id = $value->department_id;
            $tmp->department_name = $value->department->name;
            $tmp->counter_id = $value->counter_id;
            $tmp->counter_name = $value->counter->name;
            $tmp->reasons = $value->counter->visitreasons->pluck('reason')->toArray();
            $tmp->reason_ids = $value->counter->visitreasons->pluck('id')->toArray();
            $data->push($tmp);
        }
        // echo '<pre>';
        // print_r($data->where('department_name','Department 4'));
        // echo '</pre>';
        // die();

        return view('pages.onboarding.reasonforvisitcounter', compact('data', 'location', 'departments', 'step_total_count', 'step_current'));
    }

    public function users()
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $id = $location->id;
        $roles = Role::whereNotIn('name', config('app.onboard_exclude_roles'))->orderBy('name')->get();
        $departments = Department::where('location_id', $id)->get();
        $officerList = User::whereNotIn('user_type', [3])->where('location_id', $id)->orderBy('lastname', 'ASC')->withCount('pendingtokens')->get();
        $inviteList = Invitation::where('location_id', $id)->get();


        $data = array();

        foreach ($officerList as $key => $value) {
            $tmp = collect();
            $tmp->name = $value->firstname . ' ' . $value->lastname;
            $tmp->avatar_url = $value->avatar_url;
            $tmp->status = $value->status;
            foreach ($value->getRoleNames() as $_role) {
                $tmp->role = ucwords($_role);
            }

            array_push($data, $tmp);
        }

        $user = new User();

        foreach ($inviteList as $key => $value) {

            $tmp = collect();
            $tmp->id = $value->id;
            $tmp->name = $value->email;
            $tmp->avatar_url = $user->avatar_url;
            $tmp->status = 0;
            $tmp->role = $value->role->name;

            array_push($data, $tmp);
        }

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        // die();

        return view('pages.onboarding.staff', compact('roles', 'location', 'departments', 'data', 'step_total_count', 'step_current'));
    }

    private function setUserRole($onboard = true)
    {

        if ($onboard) {
            $role = Role::find(Constants::Role_Manager);
            $user = auth()->user();
            $user->syncRoles($role);
            $user->user_type = Constants::Role_Manager;
            $user->save();
        } else {
            $role = Role::find(Constants::Role_User);
            $user = auth()->user();
            $user->syncRoles($role);
            $user->user_type = Constants::Role_User;
            $user->save();
        }
    }

    public function keyList()
    {
        $chars = array_merge(range('1', '9'), range('a', 'z'));
        $list = array();
        foreach ($chars as $char) {
            if ($char != "v")
                $list[$char] = $char;
        }
        return $list;
    }

    public function queuesetup()
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $location = Company::where('created_by', auth()->user()->id)->first()->locations()->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $id = $location->id;

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


        return view('pages.onboarding.queuesetup', compact('tokens', 'countertList', 'departmentList', 'userList', 'location', 'step_total_count', 'step_current'));
    }

    public function complete()
    {
        $key_value = null;
        $this->keyCheck($key_value);

        $company = Company::where('created_by', auth()->user()->id)->first();
        $location = $company->locations->first();
        $step_total_count = Constants::Onboarding_Total_Step_Count;
        $step_current = $key_value;
        $officerList = User::whereNotIn('user_type', [3])->where('location_id', $location->id)->orderBy('lastname', 'ASC')->withCount('pendingtokens')->get();
        $inviteList = Invitation::where('location_id', $location->id)->get();
        $staff_list = array();

        foreach ($officerList as $key => $value) {
            $tmp = collect();
            $tmp->name = $value->firstname . ' ' . $value->lastname;
            $tmp->avatar_url = $value->avatar_url;
            $tmp->status = $value->status;
            foreach ($value->getRoleNames() as $_role) {
                $tmp->role = ucwords($_role);
            }

            array_push($staff_list, $tmp);
        }

        $user = new User();

        foreach ($inviteList as $key => $value) {

            $tmp = collect();
            $tmp->id = $value->id;
            $tmp->name = $value->email;
            $tmp->avatar_url = $user->avatar_url;
            $tmp->status = 0;
            $tmp->role = $value->role->name;

            array_push($staff_list, $tmp);
        }

        $tokens = TokenSetting::select('token_setting.*', 'department.name as department', 'counter.name as counter', 'user.firstname', 'user.lastname')
            ->leftJoin('department', 'token_setting.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token_setting.counter_id', '=', 'counter.id')
            ->leftJoin('user', 'token_setting.user_id', '=', 'user.id')
            ->groupBy('token_setting.location_id', 'department', 'token_setting.user_id')
            ->where('token_setting.location_id', $location->id)
            ->orderBy('department')
            ->get();

        return view('pages.onboarding.complete', compact('location', 'staff_list', 'tokens', 'step_total_count', 'step_current'));
    }
}
