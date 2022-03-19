<?php

namespace App\Http\Controllers\UserManagement;

use App\DataTables\UserManagement\PermissionsDataTable;
use App\DataTables\UserManagement\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

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
        return view('pages.apps.user-management.roles.list', compact('roles'));
    }
    public function rolesView($id)
    {
        $role = Role::find($id);

        // get the default inner page
        return view('pages.apps.user-management.roles.view', compact('role'));
    }
}
