<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FeedbackNotification;
use App\Models\Feedback;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'type' =>           'required',
            'comment'         => 'required|max:500',
        ])
            ->setAttributeNames(array(
                'type' => trans('app.type'),
                'comment' => trans('app.comment')
            ));

        if ($validator->fails()) {
            $data['status'] = false;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {


            $agent = new Agent();
            // echo '<pre>';
            // print_r($agent->platform());
            // echo '</pre>';
            // die();
            $data = [
                'name'        => auth()->user()->name,
                'email'        => auth()->user()->email,
                'type'        => $request->type,
                'comment'     => $request->comment,
                'user_id'     => auth()->user()->id,
                'user_agent'  => $request->header('User-Agent'),
                'ip_address'  => $request->ip(),
                'os_version'  => $agent->platform(),
                'browser_version' => $agent->browser(),
                'source'      => 'web',
                'referer'     => $request->header('referer'),
                'rating'      => $request->rating,
                'created_at'  => Carbon::now()
            ];

            $save = Feedback::insert($data);

            $setting = Setting::first();

            Mail::to($setting->email)->send(new FeedbackNotification($data));
            
            if ($save) {
                $data['status'] = true;
                $data['message'] = trans('app.save_successfully');
                return response()->json($data);
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data, 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
