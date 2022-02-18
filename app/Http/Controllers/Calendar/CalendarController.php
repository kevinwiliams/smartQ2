<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // get the default inner page
        return view('pages.apps.calendar');
    }


}
