<?php

namespace App\Http\Controllers\UserMangement;

use App\Http\Controllers\Controller;


class UMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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
