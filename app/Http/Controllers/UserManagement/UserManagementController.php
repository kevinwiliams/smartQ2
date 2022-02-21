<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function permissionsList()
    {
        // get the default inner page
        return view('pages.apps.user-management.permissions');
    }

    public function usersList()
    {
        // get the default inner page
        return view('pages.apps.user-management.users.list');
    }

    public function usersView()
    {
        // get the default inner page
        return view('pages.apps.user-management.users.view');
    }
    public function rolesList()
    {
        // get the default inner page
        return view('pages.apps.user-management.roles.list');
    }
    public function rolesView()
    {
        // get the default inner page
        return view('pages.apps.user-management.roles.view');
    }
}
