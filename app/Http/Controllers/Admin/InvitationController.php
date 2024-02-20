<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteStaffNotification;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function inviteStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:user',
            'user_role' => 'required',
            'location_id' => 'required'
        ])
            ->setAttributeNames(array(
                'email' => trans('app.email'),
                'user_role' => trans('app.role'),
                'location_id' => trans('app.location')
            ));


        if ($validator->fails()) {
            $data['status'] = false;
            $data['exception'] = "<ul class='list-unstyled'>";
            $messages = $validator->messages();
            foreach ($messages->all('<li>:message</li>') as $message) {
                $data['exception'] .= $message;
            }
            $data['exception'] .= "</ul>";
            return response()->json($data, 400);
        } else {

            do {
                $token = Str::random(20);
            } while (Invitation::where('token', $token)->first());

            $invitation = Invitation::create([
                'token' => $token,
                'email' => $request->email,
                'role_id' => $request->user_role,
                'location_id' => $request->location_id,
                'inviter' => auth()->user()->id,
            ]);

            $url = URL::signedRoute('invitation.accept', ['token' => $token]);
                        
            Mail::to($request->email)->send(new InviteStaffNotification($invitation, $url));

            if ($invitation) {
                $data['status'] = true;
                $data['data'] = $invitation;
                $data['message'] = trans('app.invitation_sent');
                return response()->json($data);
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }

            return response()->json($data);
        }
    }

    public function deleteInvite($id)
    {
        // if (!auth()->user()->can('delete invitation')) {
        //     $data['status'] = false;
        //     $data['message'] = trans('app.no_permissions');
        //     return response()->json($data, 400);            
        // }

        try {
            Invitation::where('id', $id)->where('inviter', auth()->user()->id)
                ->delete();

            $data['status'] = true;
            $data['message'] = trans('app.delete_successfully');
            return response()->json($data);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['exception'] = trans('app.please_try_again');
            $data['errorObj'] = $th;
            return response()->json($data, 400);
        }
    }


    public function accept($token)
    {
        $invite = Invitation::where('token', $token)->first();

        return view('auth.register', compact('invite'));
    }
}
