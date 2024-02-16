<?php

namespace App\Http\Controllers\Auth;

use App\Core\Constants;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    public function signup()
    {
        return view('auth.signup');
    }


    public function start()
    {
        return view('auth.registerbusiness');
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:user',
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => 'required'
        ])->setAttributeNames(array(
            'firstname' => trans('app.firstname'),
            'lastname' => trans('app.lastname'),
            'email' => trans('app.email'),
            'password' => trans('app.password'),
            'g-recaptcha-response' => trans('app.g-recaptcha-response'),
        ));

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        //VALIDATE RECAPTCHA
        $secret = env('GOOGLE_RECAPTCHA_SECRET');
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);


        $resp = $recaptcha->verify($request['g-recaptcha-response']);
        if (!$resp->isSuccess()) {
            $errors = $resp->getErrorCodes();
            // flash(trans('messages.parameters-fail-validation'), 'error', 'error');
            return back()->withErrors($errors)->withInput();
        }

        // if ($validator->fails()) {
        //     $data['status'] = false;
        //     $data['error'] = $validator;
        //     $data['message'] = trans('app.validation_error');

        //     return response()->json($data, 400);
        // }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'user_type' => '3',
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        
        $user_info         = new UserInfo();
        $user_info->user()->associate($user);
        $user_info->save();
        
        $role = Role::find(3);
        $user->syncRoles($role);

        event(new Registered($user));

        Auth::login($user);

        if($request->exists("onboard"))
        {      
            $key_value = auth()->user()->getSettingByKey(Constants::User_Settings_Onboarding);

            if ($key_value == null) {
                auth()->user()->setSetting(Constants::User_Settings_Onboarding, true);
            }

            return redirect("/onboarding");
        }
        
        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * Handle an incoming api registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:user',
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $token = Str::random(60);
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'      => $request->email,
            'user_type' => '3',
            'password'   => Hash::make($request->password),
            'api_token' => hash('sha256', $token),
        ]);

        $user_info         = new UserInfo();
        $user_info->user()->associate($user);
        $user_info->save();

        $role = Role::find(3);
        $user->syncRoles($role);

        return response($user);
    }
}
