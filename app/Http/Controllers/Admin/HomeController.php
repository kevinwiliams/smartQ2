<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Models\Token;
use App\Models\DisplaySetting;
use App\Http\Controllers\Common\SMS_lib;
use App\Http\Controllers\Common\Utilities_lib;
use App\Mail\OTPNotification;
use App\Models\Company;
use App\Models\ReasonForVisitCounters;
use App\Models\SmsHistory;
use App\Models\SmsSetting;
use App\Models\TokenSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;




use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{

    public function index()
    {
        $current = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();

        // if ($current) {
        //     return redirect('home/current');
        // }
        // $departments = Department::where('status',1)->pluck('name','id');
        // $departments = Department::select(
        //     'department.name',
        //     'department.id',
        //     'department.description'
        // )
        //     ->join('token_setting', 'token_setting.department_id', '=', 'department.id')
        //     ->where('department.status', 1)
        //     ->orderBy('id', 'ASC')
        //     ->distinct()
        //     ->get();

        $display = DisplaySetting::first();

        $smsalert = $display->sms_alert;
        $shownote = $display->show_note;

        $maskedemail = auth()->user()->getMaskedEmail();

        // $companies = Company::has('locations.departments')->orderBy('name', 'asc')->pluck('name', 'id');
        $companies = Company::has('locations.departments')->orderBy('name', 'asc')->get();

        // echo \Session::get('locale');
        // echo app()->getLocale();
        // die();
        return view('pages.home._index', compact('smsalert', 'maskedemail', 'shownote', 'companies'));
    }


    public function home()
    {
        @date_default_timezone_set(session('app.timezone'));

        // echo '<pre>';
        // print_r(auth()->user()->clientpendingtokens);
        // echo '</pre>';
        // die();
        return view('pages.home.home');
    }

    public function infobox()
    {
        $infobox = (object)array();
        $infobox->department = DB::table("department")->count();
        $infobox->counter = DB::table("counter")->count();
        $infobox->user  = DB::table("user")->count();
        $infobox->token = DB::table("token")
            ->select(DB::raw("
                COUNT(CASE WHEN status = '0' THEN id END) AS pending,
                COUNT(CASE WHEN status = '1' THEN id END) AS complete,
                COUNT(CASE WHEN status = '2' THEN id END) AS stop,
                COUNT(id) AS total
            "))
            ->first();

        return $infobox;
    }

    public function userPerformance()
    {
        return DB::table("user AS u")
            ->select(DB::raw("
                u.id,
                CONCAT_WS(' ', u.firstname, u.lastname) AS username,
                COUNT(CASE WHEN t.status='0' THEN t.id END) AS pending,
                COUNT(CASE WHEN t.status='1' THEN t.id END) AS complete,
                COUNT(CASE WHEN t.status='2' THEN t.id END) AS stop,
                COUNT(t.id) AS total 
            "))
            ->leftJoin("token AS t", function ($join) {
                $join->on("t.user_id", "=", "u.id");
                $join->whereDate("t.created_at", "=", date("Y-m-d"));
            })
            ->whereIn('u.user_type', [1])
            ->groupBy("u.id")
            ->get();
    }

    //chart month wise token
    public function chart_month()
    {
        return DB::select(DB::raw("
            SELECT 
                DATE_FORMAT(created_at, '%d') AS date,
                COUNT(CASE WHEN status = 1 THEN 1 END) as success,
                COUNT(CASE WHEN status = 0 THEN 1 END) as pending,
                COUNT(t.id) AS total
            FROM 
                token AS t
            WHERE  
                MONTH(created_at) >= MONTH(CURRENT_DATE()) 
            GROUP BY 
                DATE(t.created_at)
            ORDER BY 
                t.created_at ASC
        "));
    }

    //chart year wise token
    public function chart_year()
    {
        return DB::select(DB::raw("
            SELECT 
                DATE_FORMAT(created_at, '%M') AS month,
                COUNT(CASE WHEN status = 1 THEN 1 END) as success,
                COUNT(CASE WHEN status = 0 THEN 1 END) as pending,
                COUNT(t.id) AS total
            FROM 
                token AS t
            WHERE  
                YEAR(created_at) >= YEAR(CURRENT_DATE()) 
            GROUP BY 
                month
            ORDER BY 
                t.created_at ASC
        "));
    }

    //chart year wise token
    public function chart_begin()
    {
        return DB::select(DB::raw("
            SELECT 
                DATE(created_at) AS date,
                COUNT(CASE WHEN status = 1 THEN 1 END) as success,
                COUNT(CASE WHEN status = 0 THEN 1 END) as pending,
                COUNT(t.id) AS total
            FROM 
                token AS t   
        "));
    }



    /*-----------------------------------
    | Verify Phone 
    |-----------------------------------*/

    public function confirmMobile(Request $request)
    {

        $OTP = $this->generateNumericOTP(6);

        $phonenum = $this->sanitizePhoneNumber($request->phone);

        $update = User::where('id', auth()->user()->id)
            ->update([
                // 'mobile' => $request->phone,
                'otp'   => $OTP,
                'otp_type'   => 'sms',
                'otp_timestamp'   => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

        if ($update) {
            $display = DisplaySetting::first();

            $user = User::where('id', auth()->user()->id)->first();

            if ($display->sms_alert) {
                $setting  = SmsSetting::first();
                $sms_lib = new SMS_lib;

                $msg = "Hi " . auth()->user()->firstname . ", you're OTP is: $OTP";


                $data = $sms_lib
                    ->provider("$setting->provider")
                    ->api_key("$setting->api_key")
                    ->username("$setting->username")
                    ->password("$setting->password")
                    ->from("$setting->from")
                    ->to("$phonenum")
                    ->message("$msg")
                    ->response();

                //store sms information 
                $sms = new SmsHistory();
                $sms->from        = $setting->from;
                $sms->to          = $phonenum;
                $sms->message     = $msg;
                $sms->response    = $data;
                $sms->created_at  = date('Y-m-d H:i:s');

                $sms->save();

                // $data = $sms_lib
                //     ->to($request->phone)
                //     ->message($msg)
                //     ->response();
                return json_encode(array(
                    'status'      => true,
                    'request_url' => "",
                    'error'       => "",
                    'message'     => $OTP,
                    'data'        => $data
                ));
            }
        } else {
            return json_encode(array(
                'status'      => false,
                'request_url' => "",
                'error'       => "",
                'message'     => ""
            ));
        }
    }

    public function confirmWhatsApp(Request $request)
    {

        $OTP = $this->generateNumericOTP(6);
 
        $update = User::where('id', auth()->user()->id)
            ->update([
                // 'mobile' => $request->phone,
                'otp'   => $OTP,
                'otp_type'   => 'whatsapp',
                'otp_timestamp'   => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

        if ($update) {
            $user = User::where('id', auth()->user()->id)->first();
 
            $msg = "Hi *" . auth()->user()->firstname . "*, you're OTP is: *$OTP*";
            (new Utilities_lib)->sendWhatsAppText($user, $msg);
            
            return json_encode(array(
                'status'      => true,
                'request_url' => "",
                'error'       => "",
                'message'     => $OTP,
                'data'        => $msg
            ));
        } else {
            return json_encode(array(
                'status'      => false,
                'request_url' => "",
                'error'       => "",
                'message'     => ""
            ));
        }
    }

    public function confirmEmail(Request $request)
    {

        $OTP = $this->generateNumericOTP(6);


        $update = User::where('id', auth()->user()->id)
            ->update([
                // 'mobile' => $request->phone,
                'otp'   => $OTP,
                'otp_type'   => 'email',
                'otp_timestamp'   => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

        if ($update) {
            $user = User::where('id', auth()->user()->id)->first();

            Mail::to(auth()->user()->email)->send(new OTPNotification($user));

            // return json_decode($data, true);
            return json_encode(array(
                'status'      => true,
                'request_url' => "",
                'error'       => "",
                'message'     => $OTP
            ));
        } else {
            return json_encode(array(
                'status'      => false,
                'request_url' => "",
                'error'       => "",
                'message'     => ""
            ));
        }
    }

    public function confirmOTP(Request $request)
    {
        $OTP = auth()->user()->otp;

        if ($request->code == $OTP) {
            $display = DisplaySetting::first();

            if ($display->sms_alert) {
                $update = User::where('id', auth()->user()->id)
                    ->update([
                        'mobile' => $request->phone,
                        'otp_timestamp'   => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    ]);
            } else {
                $update = User::where('id', auth()->user()->id)
                    ->update([
                        'otp_timestamp'   => Carbon::now(),
                        'updated_at'  => Carbon::now()
                    ]);
            }

            return json_encode(array(
                'status'      => true,
            ));
        } else {
            return json_encode(array(
                'status'      => false,
            ));
        }
    }

    public function confirmEmailOTP(Request $request)
    {
        $OTP = auth()->user()->otp;

        if ($request->code == $OTP) {

            $update = User::where('id', auth()->user()->id)
                ->update([
                    'otp_timestamp'   => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ]);

            return json_encode(array(
                'status'      => true,
            ));
        } else {
            return json_encode(array(
                'status'      => false,
            ));
        }
    }


    public function getwaittime(Request $request)
    {
        //find auto-setting
        $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
            ->where('department_id', $request->id)
            ->groupBy('user_id')
            ->get();

        $waittime = 0;
        //if auto-setting are available
        if (!empty($settings)) {

            foreach ($settings as $setting) {
                //compare each user in today
                $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                    ->where('department_id', $setting->department_id)
                    ->where('counter_id', $setting->counter_id)
                    ->where('user_id', $setting->user_id)
                    ->whereIn('status', [0, 3])
                    ->whereRaw('DATE(created_at) = CURDATE()')
                    ->orderBy('total_tokens', 'asc')
                    ->groupBy('user_id')
                    ->first();

                //create user counter list
                $tokenAssignTo[] = [
                    'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                    'department_id' => $setting->department_id,
                    'counter_id'    => $setting->counter_id,
                    'user_id'       => $setting->user_id
                ];
            }

            //findout min counter set to 
            $min = min($tokenAssignTo);

            $officer = User::where('id', $min['user_id'])->first();
            $dept = Department::where('id', $min['department_id'])->first();
            $waittime = $min['total_tokens'] * (($officer->wait_time > 0) ? $officer->wait_time : $dept->avg_wait_time);
        }

        return json_encode(date('H:i', mktime(0, $waittime)));
    }

    public function getwaittimebyreason(Request $request)
    {
        //find auto-setting

        $counters = ReasonForVisitCounters::where('reason_id', $request->id)->pluck('counter_id')->toArray();
        $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
            ->whereIn('counter_id', $counters)
            ->groupBy('user_id')
            ->get();

        // echo '<pre>';
        // print_r($settings);
        // echo '<pre/>';
        // die();

        $waittime = 0;
        //if auto-setting are available
        if (!empty($settings)) {

            foreach ($settings as $setting) {
                //compare each user in today
                $tokenData = Token::select('department_id', 'counter_id', 'user_id', DB::raw('COUNT(user_id) AS total_tokens'))
                    ->where('department_id', $setting->department_id)
                    ->where('counter_id', $setting->counter_id)
                    ->where('user_id', $setting->user_id)
                    ->whereIn('status', [0, 3])
                    ->whereRaw('DATE(created_at) = CURDATE()')
                    ->orderBy('total_tokens', 'asc')
                    ->groupBy('user_id')
                    ->first();

                //create user counter list
                $tokenAssignTo[] = [
                    'total_tokens'  => (!empty($tokenData->total_tokens) ? $tokenData->total_tokens : 0),
                    'department_id' => $setting->department_id,
                    'counter_id'    => $setting->counter_id,
                    'user_id'       => $setting->user_id
                ];
            }

            //findout min counter set to 
            $min = min($tokenAssignTo);
            $officer = User::where('id', $min['user_id'])->first();
            $dept = Department::where('id', $min['department_id'])->first();
            $waittime = $min['total_tokens'] * (($officer->wait_time > 0) ? $officer->wait_time : $dept->avg_wait_time);
        }


        return json_encode(date('H:i', mktime(0, $waittime)));
    }

    public function getdepartments(Request $request)
    {
        $deptids = TokenSetting::where('location_id', $request->id)->pluck('department_id')->toArray();
        $dept = Department::where('location_id', $request->id)->whereIn('id', $deptids)->orderBy('name')->get();

        return json_encode($dept);
    }

    // Function to generate OTP
    function generateNumericOTP($n)
    {

        // Take a generator string which consist of
        // all numeric digits
        $generator = "1234567890";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result
        return $result;
    }


    function sanitizePhoneNumber($phone)
    {

        // Using str_replace() function 
        // to replace the word 
        $res = str_replace(array(
            '(', ')',
            '-', ' '
        ), '', $phone);

        // Returning the result 
        return $res;
    }
}
