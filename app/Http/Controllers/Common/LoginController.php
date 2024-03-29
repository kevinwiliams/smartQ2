<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Setting;
use App\Models\DisplayCustom;
use App\Models\DisplaySetting;
use App\Models\Token;
use App\Models\UserSocialAccount;
use Auth, Session, DB, Hash;

class LoginController extends Controller
{
    use ThrottlesLogins; 
    
    public function login()
    {  
        ///TODO: figure out default setting and location setting
        /// figure out display settings
        
        $app = Setting::first(); 
        // $display = DisplaySetting::first();         
        // $customDisplays = DisplayCustom::where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        // if (!empty($customDisplays))
        // {
        //     \Session::put('custom_displays', $customDisplays); 
        // }
        // echo '<pre>';
        // print_r($app);
        // echo '</pre>';
        // die();
        if(!empty($app))
        {
            \Session::put('app', array(
                'title'   => $app->title, 
                'favicon' => $app->favicon, 
                'logo'    => $app->logo, 
                'timezone' => $app->timezone, 
                'display'  => 0, 
                'copyright_text' => $app->copyright_text, 
            )); 
        } 
        return view('layouts.login');
    }


    public function checkLogin(Request $request)
    {
        //start login throttoling
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return redirect('login')->with('exception', trans('app.to_many_login_attempts'));
        }
        $this->incrementLoginAttempts($request);
        //end login throttoling

        if (\Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {

            $authUser = Auth::user();
            unset($authUser->password); 
            Auth::login($authUser, true); 

            if ($authUser->status == '0') 
            {
                Auth::logout(); 
                return redirect('login')->with('exception', trans('app.contact_with_authurity'));
            } 
            else if (!empty($authUser->user_type)) 
            {                  
                $customDisplays = DisplayCustom::where('status', 1)->where('location_id',$authUser->location_id)->orderBy('name', 'ASC')->pluck('name', 'id');
                if (!empty($customDisplays))
                {
                    \Session::put('custom_displays', $customDisplays); 
                }        
              
                return redirect(strtolower(auth()->user()->role()));
            } 
            else 
            {
                Auth::logout(); 
                return redirect('login')->with('exception', trans('app.contact_with_authurity'));
            }

        }else{
            return redirect()->back()->with('exception', trans('app.invalid_credential'));
        }
    }  

    public function logout()
    { 
        Session::flush();
        Auth::logout();        
        return redirect('login')->with('message', trans('app.signout_successfully'));
    }

    //prerequisite for login throttling
    public function username()
    {
        return 'email';
    }


    /*----------------------------------------------------------------
    |--------GOOGLE AUTHENTICATION------------------------------------
    |----------------------------------------------------------------*/
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        try {
            return Socialite::driver($request->provider)->redirect();
        } catch (Exception $e) {
            return redirect('login')->with('message', trans('app.invalid_credential'));
        }
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        try { 
            $user = Socialite::driver($request->provider)->user();
        } catch (Exception $e) {
            return redirect('login')->with('exception', trans('app.invalid_credential'));
        }

        $authUser = $this->findOrCreateUser($user, $request->provider);

        Auth::login($authUser, true); 

        if ($authUser->status == '0') 
        {
            return redirect('login')->with('exception', trans('app.contact_with_authurity'));
        } 
        else if (!empty($authUser->user_type)) 
        {
            $customDisplays = DisplayCustom::where('status', 1)->where('location_id',$authUser->location_id)->orderBy('name', 'ASC')->pluck('name', 'id');
            if (!empty($customDisplays))
            {
                \Session::put('custom_displays', $customDisplays); 
            }

            return redirect(strtolower(auth()->user()->role()));
        } 
        else 
        {
            Auth::logout(); 
            return redirect('login')->with('exception', trans('app.contact_with_authurity'));
        }
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user
     * @return User
     */
    public function findOrCreateUser($providerUser = [], $provider = null)
    {
        $existsAccount = UserSocialAccount::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();

        if ($existsAccount) 
        { 
            $currentuser = $existsAccount->user()->first();

            if($currentuser->photo != $providerUser->getAvatar()){
                $update = User::where('id', $currentuser->id)
                ->update([ 'photo' => $providerUser->getAvatar()]);
            }

            return $existsAccount->user()->first();
        } 
        else 
        {
            $user = User::where('email', $providerUser->getEmail())->first();

            if (! $user) {
                
                $fullname = explode(" ", $providerUser->getName());

                $user = User::create([  
                    'firstname' => $fullname[0],
                    'lastname'  => isset($fullname[1]) ? $fullname[1] : '',
                    'email'     => $providerUser->getEmail(),
                    'password'  => Hash::make($providerUser->getId()), 
                    'photo'     => $providerUser->getAvatar(),
                    'user_type' => '3', // client
                    'created_at' => date('Y-m-d H:i:s'),
                    'status'    => '1',
                ]);
            }

            $user->accounts()->create([
                'user_id'       => $user->id,
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider,
                'created_at'    => date('Y-m-d H:i:s'),
            ]);
 
            return $user;
        }
    }

}
