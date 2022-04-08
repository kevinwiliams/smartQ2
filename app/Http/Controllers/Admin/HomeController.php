<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Models\Token;
use App\Models\DisplaySetting;
use App\Http\Controllers\Common\SMS_lib;
use App\Mail\OTPNotification;
use App\Models\Company;
use App\Models\SmsHistory;
use App\Models\SmsSetting;
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

        if ($current) {
            return redirect('home/current');
        }
        // $departments = Department::where('status',1)->pluck('name','id');
        $departments = Department::select(
            'department.name',
            'department.id',
            'department.description'
        )
            ->join('token_setting', 'token_setting.department_id', '=', 'department.id')
            ->where('department.status', 1)
            ->orderBy('id', 'ASC')
            ->distinct()
            ->get();

        $display = DisplaySetting::first();

        $smsalert = $display->sms_alert;
        $shownote = $display->show_note;

        $maskedemail = $this->maskEmail(auth()->user()->email);
        
        $companies = Company::orderBy('name','asc')->pluck('name','id');

        return view('pages.home.index', compact('departments', 'smsalert', 'maskedemail','shownote','companies'));
    }

    function maskEmail($x)
    {
        $arr = explode("@", trim($x));

        return $arr[0][0] . str_repeat("*", strlen($arr[0])  - 2) . $arr[0][strlen($arr[0]) - 1] . "@" . $arr[1];
    }

    public function home()
    {
        @date_default_timezone_set(session('app.timezone'));
   
        $infobox = $this->infobox();
        $performance = $this->userPerformance();
        $month = $this->chart_month();
        $year = $this->chart_year();
        $begin = $this->chart_begin();

        return view('pages.home.home', compact(
            'infobox',
            'performance',
            'month',
            'year',
            'begin'
        ));
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
                $sms->to          = $request->to;
                $sms->message     = $request->message;
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
        $dept = Department::find($request->id);
        $waiting = Token::whereIn('status', [0, 3])->where('department_id', $request->id)->count();
        $waiting = $waiting - 1;

        $waittime = 0;

        $waittime = ($dept->avg_wait_time != null) ? $dept->avg_wait_time * $waiting : $waiting * 1;
        return json_encode(date('H:i', mktime(0, $waittime)));
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
