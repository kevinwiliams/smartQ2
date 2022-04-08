<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTables\UserManagement\PermissionsDataTable;
use App\DataTables\UserManagement\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserSocialAccount;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function permissionsList(PermissionsDataTable $dataTable)
    {
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

    // public function usersList()
    // {
    //     // get the default inner page
    //     return view('pages.apps.user-management.users.list');
    // }

    public function usersList(UsersDataTable $dataTable)
    {
        $roles = Role::get();
        $departments = Department::get();
        return $dataTable->render('pages.apps.user-management.users.index', compact('roles', 'departments'));
    }

    public function usersView()
    {
        // get the default inner page
        return view('pages.apps.user-management.users.view');
    }

    public function usersEdit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $departments = Department::get();
        // get the default inner page
        return view('pages.apps.user-management.users.view', compact('user', 'roles', 'departments'));
    }

    public function deleteUser($id)
    {

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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'language' => 'required',
            'phone' => 'required',
            'country' => 'required'
        ])
            ->setAttributeNames(array(
                'firstname' => trans('app.firstname'),
                'lastname' => trans('app.lastname'),
                'email' => trans('app.email'),
                'language' => trans('app.language'),
                'phone' => trans('app.phone'),
                'country' => trans('app.country')
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
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->mobile = $request->phone;

            if ($request->has('department'))
                $user->department_id = $request->department;

            $user->save();

            $userInfo = UserInfo::where('user_id', $id)->first();
            if ($userInfo) {
                $userInfo->phone = $request->phone;
                $userInfo->country = $request->country;
                $userInfo->language = $request->language;

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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'language' => 'required',
            'phone' => 'required',
            'language' => 'required',
            'department' => 'required',
            'country' => 'required',
        ])
            ->setAttributeNames(array(
                'firstname' => trans('app.firstname'),
                'lastname' => trans('app.lastname'),
                'email' => trans('app.email'),
                'language' => trans('app.language'),
                'phone' => trans('app.phone'),
                'country' => trans('app.country'),
                'department' => trans('app.department'),
                'language' => trans('app.language'),
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
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'      => $request->email,
                'password'   => Hash::make($request->email),
                'department_id'      => $request->department,
                'photo'     => '',
                'user_type' => '3', // client
                'created_at' => date('Y-m-d H:i:s'),
                'status'    => '1',
            ]);

            $role = Role::find($request->user_role);
            $user->syncRoles($role);

            $user_info         = new UserInfo;
            $user_info->avatar = '';
            $user_info->country = $request->country;
            $user_info->language = $request->language;
            $user_info->user()->associate($user);
            $user_info->save();


            ///TODO: implement email to user and autopassword

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

    public function updateUserEmail(Request $request, $id)
    {
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

    public function updateUserPassword(Request $request, $id)
    {
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

        $role = Role::find($request->user_role);
        $user = User::find($request->user_id);
        $user->syncRoles($role);

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
}
