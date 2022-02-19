<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserSocialAccount;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;

class SocialiteLoginController extends Controller
{
    public function redirect($provider)
    {
        $redirect = parse_url(request()->input('redirect_uri'), PHP_URL_PATH);
        Cookie::queue('redirect_uri', $redirect, 3);

        // redirect from social site
        if (request()->input('state')) {
            return $this->callback($provider);
        }

        // request login from social site
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            // get user info from social site
            $social_info = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->to(Cookie::get('redirect_uri'));
        }

        // check for existing user
        $existing_user = User::where('email', $social_info->getEmail())->first();

        if ($existing_user) {
            auth()->login($existing_user, true);
            if($existing_user->photo != $social_info->getAvatar()){
                $update = User::where('id', $existing_user->id)
                ->update([ 'photo' => $social_info->getAvatar()]);
            }

            return redirect()->to(Cookie::get('redirect_uri'));
        }

        $new_user = $this->createUser($social_info,$provider);

        auth()->login($new_user, true);

        return redirect()->to(Cookie::get('redirect_uri'));
    }

    function createUser(SocialiteUser $social_info, $provider = null)
    {
        $user = User::where('email', $social_info->email)->first();

        $name = explode(" ", $social_info->name);

        if (!$user) {
            $user = User::create([
                'firstname' => $name[0] ?? '',
                'lastname'  => $name[1] ?? '',
                'email'      => $social_info->email,
                'password'   => Hash::make($social_info->id),                
                'photo'     => $social_info->getAvatar(),
                'user_type' => '3', // client
                'created_at' => date('Y-m-d H:i:s'),
                'status'    => '1',
            ]);

            $user_info         = new UserInfo;
            $user_info->avatar = $social_info->getAvatar();
            $user_info->user()->associate($user);
            $user_info->save();

            $social_account     = new UserSocialAccount;
            $social_account->user_id = $user->id;
            $social_account->provider_id = $social_info->getId();
            $social_account->provider_name = $provider;
            $social_account->created_at = date('Y-m-d H:i:s');
            $social_account->save(); 

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }

        return $user;
    }
}
