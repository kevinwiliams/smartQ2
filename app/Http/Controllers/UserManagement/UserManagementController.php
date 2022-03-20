<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTables\UserManagement\PermissionsDataTable;
use App\DataTables\UserManagement\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;

class UserManagementController extends Controller
{
    public function _permissionsList()
    {
        // get the default inner page
        return view('pages.apps.user-management.permissions.permissions');
    }

    public function permissionsList(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.user-management.permissions.index');
    }

    // public function usersList()
    // {
    //     // get the default inner page
    //     return view('pages.apps.user-management.users.list');
    // }

    public function usersList(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.user-management.users.index');
    }

    public function usersView()
    {
        // get the default inner page
        return view('pages.apps.user-management.users.view');
    }
    public function rolesList()
    {
        $roles = Role::get();
        $permissions = Permission::get()->pluck('name', 'id');;


        // foreach ($roles as $_role) {

        //     foreach ($_role->permissions as $_perm) {
        //         // echo '<pre>';
        //         // print_r($_perm);
        //         // echo '</pre>';
        //         echo $_perm->name;
        //     }

        // }
        // die();

        // get the default inner page
        return view('pages.apps.user-management.roles.list', compact('roles', 'permissions'));
    }
    public function rolesView($id)
    {
        $role = Role::find($id);

        // get the default inner page
        return view('pages.apps.user-management.roles.view', compact('role'));
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
            $role = Role::create(['name' => $request->role_name, 'description' => $request->role_description]);
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
}
