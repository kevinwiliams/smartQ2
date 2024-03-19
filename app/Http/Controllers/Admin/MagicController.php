<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MagicController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        $magic = Magic::where('token', $request->token)->first();
        if ($magic) {
            redirect($magic->url);
        } else {
            Session::flash("fail", trans('app.invalid_token'));
            redirect('home');
        }
    }

    public function makeMagic($url)
    {

        do {
            $token = Str::random(20);
        } while (Magic::where('token', $token)->first());


        $signed_url = URL::signedRoute('magic', ['token' => $token]);

        $invitation = Magic::create([
            'token' => $token,
            'url' => $url,
            'signed_url' => $signed_url
        ]);

        $data['token'] = $token;
        $data['signed_url'] = $signed_url;
        $data['magic'] = ltrim(str_replace(env('APP_URL'), "", $signed_url),"/");
        return $data;
    }
}
