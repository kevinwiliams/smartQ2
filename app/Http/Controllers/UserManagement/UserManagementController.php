<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTables\UserManagement\PermissionsDataTable;
use App\DataTables\UserManagement\UsersDataTable;
use App\Http\Controllers\Common\SMS_lib;
use App\Http\Controllers\Common\Utilities_lib;
use App\Http\Controllers\Controller;
use App\Mail\CustomerNotification;
use App\Mail\NewUserNotification;
use App\Mail\OTPNotification;
use App\Models\Department;
use App\Models\Location;
use App\Models\Counter;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SmsHistory;
use App\Models\SmsSetting;
use App\Models\Token;
use App\Models\TokenSetting;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserSocialAccount;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Models\Activity;
use Storage;

class UserManagementController extends Controller
{
    public function permissionsList(PermissionsDataTable $dataTable)
    {
        if (!auth()->user()->can('read permission')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        return $dataTable->render('pages.apps.user-management.permissions.index');
    }

    public static function createPermission(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));


        $validator = Validator::make($request->all(), [
            'permission_name' => 'required|unique:permissions,name',
            'permission_description' => 'required',


        ])
            ->setAttributeNames(array(
                'permission_name' => trans('app.permission_name'),
                'permission_description' => trans('app.permission_description'),
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
            $permission = Permission::create(['name' => $request->permission_name, 'description' => $request->permission_description, 'editable' => ($request->has('permissions_core')) ? 1 : 0]);

            if ($permission) {

                $data['status'] = true;
                $data['message'] = trans('app.permission_created');
                $data['permission']  = $permission;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    public function updatePermission(Request $request, $id)
    {
        @date_default_timezone_set(session('app.timezone'));


        $validator = Validator::make($request->all(), [
            'permission_name' => 'required',
            'permission_description' => 'required',
        ])
            ->setAttributeNames(array(
                'permission_name' => trans('app.permission_name'),
                'permission_description' => trans('app.permission_description'),
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
            $permission = Permission::find($id);
            $permission->name = $request->permission_name;
            $permission->description = $request->permission_description;
            $permission->editable = ($request->has('permissions_core')) ? 1 : 0;
            $permission->save();

            if ($permission) {

                $data['status'] = true;
                $data['message'] = trans('app.permission_created');
                $data['permission']  = $permission;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }


    public function deletePermission($id)
    {

        $permission = Permission::find($id);
        $permission->delete();

        $data['status'] = true;
        $data['message'] = trans('app.permission_deleted');

        return response()->json($data);
    }

    public function officersList($id = null)
    {
        if (!auth()->user()->can('edit location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        // get the default inner page
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)->first();

        $roles = Role::whereNotIn('name', config('app.exclude_roles'))->orderBy('name')->get();
        $departments = Department::where('location_id', $id)->get();
        $officerList = User::whereNotIn('user_type', [3])->where('location_id', $id)->orderBy('lastname', 'ASC')->withCount('pendingtokens')->get();
        return view('pages.apps.user-management.users.staff', compact('officerList', 'officers', 'location', 'counters', 'departments', 'roles'));
    }

    public function customerList($id = null)
    {
        if (!auth()->user()->can('edit location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        // get the default inner page
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)->first();

        $roles = Role::get();
        $departments = Department::get();
        $userids = Token::where('location_id', auth()->user()->location_id)->pluck('client_id')->toArray();
        $officerList = User::where('user_type', 3)->whereIn('id', $userids)->orderBy('lastname', 'ASC')->get();
        return view('pages.apps.user-management.users.customer', compact('officerList', 'officers', 'location', 'counters', 'departments'));
    }

    public function usersList(UsersDataTable $dataTable)
    {
        if (!auth()->user()->can('read user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $roles = Role::get();
        $departments = Department::get();
        return $dataTable->render('pages.apps.user-management.users.index', compact('roles', 'departments'));
    }

    public function getOfficersByCounter($id)
    {
        $officers = TokenSetting::select('user.id as id', DB::raw('CONCAT(user.firstname, " ", user.lastname) as full_name'))
            ->leftJoin('department', 'token_setting.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token_setting.counter_id', '=', 'counter.id')
            ->leftJoin('user', 'token_setting.user_id', '=', 'user.id')
            ->where('token_setting.counter_id', $id)
            ->where('token_setting.location_id', auth()->user()->location_id)
            ->orderBy('full_name')
            ->get();
        return response()->json($officers);
    }

    public function usersView()
    {
        // get the default inner page
        return view('pages.apps.user-management.users.view');
    }

    public function staffEdit($id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $user = User::find($id);
        $roles = Role::whereNotIn('name', config('app.exclude_roles'))->orderBy('name')->get();
        $departments = Department::where('location_id', $user->location_id)->orderBy('name')->get();
        $locations =  $user->location->company->locations->pluck('name', 'id'); //Department::where('location_id', $user->location_id)->orderBy('name')->get();
        $departmentlist = Department::where('location_id', $user->location_id)->orderBy('name')->pluck('name', 'id');
        // get the default inner page

        // $avatar = public_path($user->info->avatar);
        // // $avatar = storage_path($user->info->avatar);
        // echo '<pre>';
        // print_r($avatar);
        // echo '</pre>';

        // if (is_file($avatar) && file_exists($avatar)) {
        //     echo 'here';
        // }
        // die();
        return view('pages.apps.user-management.users.viewstaff', compact('user', 'roles', 'departments', 'locations', 'departmentlist'));
    }

    public function usersEdit($id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $user = User::find($id);
        $roles = Role::get();
        $departments = Department::get();
        // get the default inner page

        // $avatar = public_path($user->info->avatar);
        // // $avatar = storage_path($user->info->avatar);
        // echo '<pre>';
        // print_r($avatar);
        // echo '</pre>';

        // if (is_file($avatar) && file_exists($avatar)) {
        //     echo 'here';
        // }
        // die();
        return view('pages.apps.user-management.users.view', compact('user', 'roles', 'departments'));
    }

    public function customersView($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $departments = Department::get();
        $activities = Activity::where('causer_type', 'App\Models\User')->where('causer_id', $id)->where('log_name', 'activity')->orderByDesc('created_at')->get();
        // get the default inner page
        return view('pages.apps.user-management.users.customerView', compact('user', 'roles', 'departments', 'activities'));
    }


    public function deleteUser($id)
    {
        if (!auth()->user()->can('delete user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $user = User::find($id);
        $_info = UserInfo::where('user_id', $id)->first();
        $_social = UserSocialAccount::where('user_id', $id)->first();
        if ($_info)
            $_info->delete();

        if ($_social)
            $_social->delete();

        $user->delete();

        $data['status'] = true;
        $data['message'] = trans('app.user_deleted');

        return response()->json($data);
    }

    public function updateUser(Request $request, $id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'language' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'photo'       => 'image|mimes:jpeg,png,jpg,gif|max:3072',
        ])
            ->setAttributeNames(array(
                'firstname' => trans('app.firstname'),
                'lastname' => trans('app.lastname'),
                'email' => trans('app.email'),
                'language' => trans('app.language'),
                'phone' => trans('app.phone'),
                'country' => trans('app.country'),
                'photo' => trans('app.photo'),
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
            $filePath = null;
            if (!empty($request->photo)) {
                $filePath = 'assets/img/avatars/' . date('ymdhis') . '.jpg';
                $photo = $request->photo;
                Image::make($photo)->resize(300, 300)->save(public_path(Storage::url($filePath)));
            } else if (!empty($request->old_photo)) {
                $filePath = $request->old_photo;
                if ($request->has('remove_photo')) {
                    $filePath = null;
                }
            }

            $user = User::find($id);
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->mobile = $request->phone;
            $user->photo = $filePath;

            if ($request->has('department'))
                $user->department_id = $request->department;

            $user->save();

            $userInfo = UserInfo::where('user_id', $id)->first();
            if ($userInfo) {
                $userInfo->phone = $request->phone;
                $userInfo->country = $request->country;
                $userInfo->language = $request->language;
                $userInfo->avatar = $filePath;
                if ($request->has('company'))
                    $userInfo->company = $request->company;

                if ($request->has('website'))
                    $userInfo->website = $request->website;

                $userInfo->save();
            }

            if ($user) {

                $data['status'] = true;
                $data['message'] = trans('app.user_updated');
                $data['user']  = $user;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    public function createUser(Request $request)
    {
        if (!auth()->user()->can('create user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'language' => 'required',
            'phone' => 'required',
            'language' => 'required',
            'department' => 'required',
            'country' => 'required',
            'location' => 'required',
            'photo'       => 'image|mimes:jpeg,png,jpg,gif|max:3072',
        ])
            ->setAttributeNames(array(
                'firstname' => trans('app.firstname'),
                'lastname' => trans('app.lastname'),
                'email' => trans('app.email'),
                'language' => trans('app.language'),
                'phone' => trans('app.phone'),
                'country' => trans('app.country'),
                'department' => trans('app.department'),
                'location' => trans('app.location'),
                'photo' => trans('app.photo'),
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
            //1=officer, 2=staff, 3=client, 5=admin
            $filePath = null;
            if (!empty($request->photo)) {
                $filePath = 'assets/img/avatars/' . date('ymdhis') . '.jpg';
                $photo = $request->photo;
                Image::make($photo)->resize(300, 300)->save(public_path(Storage::url($filePath)));
            } else if (!empty($request->old_photo)) {
                $filePath = $request->old_photo;
                if ($request->has('remove_photo')) {
                    $filePath = null;
                }
            }


            $newpassword = Str::random(8);

            $user = User::create([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'      => $request->email,
                'mobile'      => $request->phone,
                'password'   => Hash::make($newpassword),
                'department_id'   => ($request->user_role != 3) ? $request->department : null,
                'location_id'      => ($request->user_role != 3) ? $request->location : null,
                'photo'     => $filePath,
                'user_type' => $request->user_role, // client
                'created_at' => date('Y-m-d H:i:s'),
                'status'    => '1',
            ]);

            $role = Role::find($request->user_role);
            $user->syncRoles($role);

            $user_info         = new UserInfo;
            $user_info->country = $request->country;
            $user_info->language = $request->language;
            $user_info->avatar = $filePath;
            $user_info->phone = $request->phone;
            $user_info->user()->associate($user);
            $user_info->save();

            Mail::to($user->email)->send(new NewUserNotification($user, $newpassword));

            if ($user) {

                $data['status'] = true;
                $data['message'] = trans('app.user_created');
                $data['user']  = $user;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }



    public function updateUserStatus(Request $request, $id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $validator = Validator::make($request->all(), [
            // 'profile_email' => 'required'
        ])
            ->setAttributeNames(array(
                // 'profile_email' => trans('app.email')
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
            $user = User::find($id);
            $user->status = $request->has('status') ? 1 : 0;
            $user->save();

            $setting = TokenSetting::where('user_id', $id)->first();
            if ($setting) {
                $setting->status = $request->has('status') ? 1 : 0;
                $setting->save();
            }

            if ($user) {

                $data['status'] = true;
                $data['message'] = trans('app.user_updated');
                $data['user']  = $user;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    public function updateUserEmail(Request $request, $id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $validator = Validator::make($request->all(), [
            'profile_email' => 'required'
        ])
            ->setAttributeNames(array(
                'profile_email' => trans('app.email')
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
            $user = User::find($id);
            $user->email = $request->profile_email;
            $user->email_verified_at = null;
            $user->save();

            if ($user) {

                $data['status'] = true;
                $data['message'] = trans('app.user_updated');
                $data['user']  = $user;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    public function updateUserLocation(Request $request, $id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $validator = Validator::make($request->all(), [
            'location_id' => 'required',
            'department_id' => 'required'
        ])
            ->setAttributeNames(array(
                'location_id' => trans('app.location'),
                'department_id' => trans('app.department')
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
            $user = User::find($id);
            $user->department_id = $request->department_id;
            $user->location_id = $request->location_id;
            $user->save();

            TokenSetting::where('user_id', $id)->delete();

            if ($user) {

                $data['status'] = true;
                $data['message'] = trans('app.user_updated');
                $data['user']  = $user;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    public function sendnotification(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'notification_type' => 'required'
        ])
            ->setAttributeNames(array(
                'message' => trans('app.message'),
                'notification_type' => trans('app.notification_type')
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
            $user = User::find($id);

            if ($user) {

                $location = auth()->user()->location_id;
                switch ($request->notification_type) {
                    case 'email':
                        Mail::to($user->email)->send(new CustomerNotification($user->firstname, $request->message));

                        (new Utilities_lib)->notificationLog($request->notification_type, $user, $user->email, $location, 'Client Notification', $request->message, 'Sent', '');
                        break;
                    case 'sms':
                        $setting  = SmsSetting::first();
                        $sms_lib = new SMS_lib;

                        $phonenum = (new Utilities_lib)->sanitizePhoneNumber($user->mobile);

                        $_data = $sms_lib
                            ->provider("$setting->provider")
                            ->api_key("$setting->api_key")
                            ->username("$setting->username")
                            ->password("$setting->password")
                            ->from("$setting->from")
                            ->to("$phonenum")
                            ->message("$request->message")
                            ->response();

                        (new Utilities_lib)->notificationLog($request->notification_type, $user, $phonenum, $location, 'Client Notification', $request->message, 'Sent', $_data);
                        //store sms information 
                        // $sms = new SmsHistory();
                        // $sms->from        = $setting->from;
                        // $sms->to          = $phonenum;
                        // $sms->message     = $request->message;
                        // $sms->response    = $_data;
                        // $sms->created_at  = date('Y-m-d H:i:s');

                        // $sms->save();

                        break;
                    case 'push':
                        $response = (new Utilities_lib)->sendPushNotification($user, $request->message, $location,'Client Notification');                        
                        break;
                    case 'whatsapp':
                        $response = (new Utilities_lib)->sendWhatsAppText($user, $request->message);
                        ///TODO: get interaction id from response
                        (new Utilities_lib)->notificationLog($request->notification_type, $user, $user->mobile, $location, 'Client Notification', $request->message, 'Sent', $response);
                        break;
                }

                activity('activity')
                    ->withProperties(['activity' => 'Client Notification', 'notification_type' => ucfirst($request->notification_type), 'message' => $request->message])
                    ->causedBy($user)
                    ->log(':properties.notification_type notification sent');

                $data['data'] = $response;
                $data['status'] = true;
                $data['message'] = trans('app.message_sent');
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.message_not_sent');
            }
        }
        return response()->json($data);
    }

    public function updateUserPassword(Request $request, $id)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ])->setAttributeNames(array(
            'password' => trans('app.password')
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
            $user = User::find($id);

            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
            }

            $data['status'] = true;
            $data['message'] = trans('app.password_reset');
            $data['user']  = $user;
        }

        return response()->json($data);
    }

    public function rolesList()
    {
        if (!auth()->user()->can('read role')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $roles = Role::orderBy('name')->get();
        $permissions = Permission::get();


        // foreach ($roles as $_role) {

        //     foreach ($permissions as $_perm) {
        //         echo '<pre>';
        //         print_r($_perm);
        //         echo '</pre>';
        //         // echo $_perm->name;
        //     }

        // // }
        // echo '<pre>';
        // print_r($permissions);
        // echo '</pre>';
        // die();

        // get the default inner page
        return view('pages.apps.user-management.roles.list', compact('roles', 'permissions'));
    }

    public function assignRole(Request $request)
    {
        if (!auth()->user()->can('edit user')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        $role = Role::find($request->user_role);
        $user = User::find($request->user_id);
        $user->syncRoles($role);
        $user->user_type = $request->user_role;
        $user->save();

        $data['status'] = true;
        $data['message'] = trans('app.user_role_assigned');

        return response()->json($data);
    }

    public function rolesView($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        // get the default inner page
        return view('pages.apps.user-management.roles.view', compact('role', 'permissions'));
    }

    public function createRole(Request $request)
    {
        if (!auth()->user()->can('create role')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));


        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,name',
            'role_description' => 'required',
            'permissions' => 'required'
        ])
            ->setAttributeNames(array(
                'role_name' => trans('app.role_name'),
                'role_description' => trans('app.role_description'),
                'permissions' => trans('app.permissions'),
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

            $role = Role::create(['name' => $request->role_name, 'description' => $request->role_description, 'editable' => ($request->has('role_core')) ? 0 : 1]);
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            foreach ($permissions as $_permission) {
                $role->givePermissionTo($_permission);
            }

            if ($role) {

                $data['status'] = true;
                $data['message'] = trans('app.role_created');
                $data['role']  = $role;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }

    public function updateRole(Request $request, $id)
    {
        if (!auth()->user()->can('edit role')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));


        $validator = Validator::make($request->all(), [
            'role_name' => 'required',
            'permissions' => 'required'
        ])
            ->setAttributeNames(array(
                'role_name' => trans('app.role_name'),
                'permissions' => trans('app.permissions'),
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
            $role = Role::find($id);
            $role->name = $request->role_name;
            $role->description = $request->role_description;
            $role->editable = ($request->has('role_core')) ? 0 : 1;
            $role->save();

            $permissions = Permission::whereIn('id', $request->permissions)->get();

            $role->syncPermissions($permissions);

            if ($role) {

                $data['status'] = true;
                $data['message'] = trans('app.role_created');
                $data['role']  = $role;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    }


    public function deleteRole($id)
    {
        if (!auth()->user()->can('delete role')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $role = Role::find($id);
        $role->delete();

        $data['status'] = true;
        $data['message'] = trans('app.role_deleted');

        return response()->json($data);
    }


    public function savePushNotificationToken(Request $request)
    {
        auth()->user()->update(['user_token' => $request->token, 'token_date' => Carbon::now(), 'push_notifications' => true]);
        return response()->json(['token saved successfully.']);
    }

    /*
    public function sendPushNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('user_token')->pluck('user_token')->all();
        $SERVER_API_KEY = config('larafirebase.authentication_key');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }
    */
}
