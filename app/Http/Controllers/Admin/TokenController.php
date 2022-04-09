<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Token\TokenDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\SMS_lib;
use App\Http\Controllers\Common\Token_lib;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Token;
use App\Models\DisplaySetting;
use App\Models\TokenSetting;
use App\Models\SmsSetting;
use App\Models\SmsHistory;
use Carbon\Carbon;

use DB, Validator;

class TokenController extends Controller
{
 
    /*-----------------------------------
    | AUTO TOKEN SETTING
    |-----------------------------------*/

    public function tokenSettingView()
    { 
        $tokens = TokenSetting::select('token_setting.*', 'department.name as department', 'counter.name as counter', 'user.firstname', 'user.lastname')
                ->leftJoin('department', 'token_setting.department_id', '=', 'department.id')
                ->leftJoin('counter', 'token_setting.counter_id', '=', 'counter.id')
                ->leftJoin('user', 'token_setting.user_id', '=', 'user.id')
                // ->groupBy('token_setting.location_id')
                ->orderBy('token_setting.location_id')
                ->orderBy('department')
                ->get();
 
        $countertList = Counter::select('counter.*', 'token_setting.counter_id')
                ->leftJoin('token_setting', 'counter.id', '=', 'token_setting.counter_id')
                ->where('counter.status',1)
                ->whereNull('token_setting.counter_id')
                ->pluck('name','id');
        

        $departmentList = Department::where('status',1)->pluck('name','id');

        $userList = User::select('user.id', DB::raw('CONCAT(user.firstname, " ", user.lastname) as full_name') )
                ->leftJoin('token_setting', 'user.id', '=', 'token_setting.user_id')
                ->where('user.user_type',1)
                ->where('user.status',1)
                ->whereNull('token_setting.user_id')
                ->orderBy('user.firstname', 'ASC')
                ->pluck('full_name', 'user.id'); 

        return view('pages.token.setting', compact('tokens','countertList','departmentList','userList')); 
    }

    public function tokenSetting(Request $request)
    {   
        @date_default_timezone_set(session('app.timezone'));
        
        
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|max:11',
            'counter_id'    => 'required|unique:token_setting,counter_id|max:11',
            'user_id'       => 'required|unique:token_setting,user_id|max:11'
        ])
        ->setAttributeNames(array( 
           'department_id' => trans('app.department'),
           'counter_id' => trans('app.counter'),
           'user_id' => trans('app.officer') 
        )); 

        if ($validator->fails()) {
            return redirect('token/setting')
                        ->withErrors($validator)
                        ->withInput();
        } else { 

            $check = TokenSetting::where('department_id',$request->department_id)
                    ->where('counter_id',$request->counter_id)
                    ->where('user_id',$request->user_id)
                    ->count();
            if ($check > 0) {
                return back()->with('exception', trans('app.setup_already_exists'))
                    ->withInput();
            }

            $save = TokenSetting::insert([ 
                'department_id' => $request->department_id,
                'counter_id'    => $request->counter_id, 
                'user_id'       => $request->user_id, 
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => null,
                'status'        => 1
            ]);

            if ($save) {
                return back()->withInput()->with('message',  trans('app.setup_successfully'));
            } else {
                return back()->withInput()->with('exception', trans('app.please_try_again'));
            }

        }
    }
 
    public function tokenDeleteSetting($id = null)
    {
        TokenSetting::where('id', $id)->delete();
        return back()->with('message', trans('app.delete_successfully'));
    } 
 
 
    /*-----------------------------------
    | AUTO TOKEN 
    |-----------------------------------*/

    public function tokenAutoView()
    {
        $display = DisplaySetting::first();
        $keyList = DB::table('token_setting AS s')
            ->select('d.key', 's.department_id', 's.counter_id', 's.user_id')
            ->leftJoin('department AS d', 'd.id', '=', 's.department_id')
            ->where('s.status', 1)
            ->get();
        $keyList = json_encode($keyList);

        if ($display->display == 5)
        {
            $departmentList = TokenSetting::select( 
                    'department.name',
                    'department.description',
                    'token_setting.department_id',
                    'token_setting.counter_id',
                    'token_setting.user_id',
                    DB::raw('CONCAT(user.firstname ," " ,user.lastname) AS officer')
                )
                ->join('department', 'department.id', '=', 'token_setting.department_id')
                ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
                ->join('user', 'user.id', '=', 'token_setting.user_id')
                ->where('token_setting.status',1)
                ->groupBy('token_setting.user_id')
                ->orderBy('token_setting.department_id', 'ASC')
                ->get();
        }
        else
        {
            $departmentList = TokenSetting::select( 
                    'department.name',
                    'department.description',
                    'token_setting.department_id',
                    'token_setting.counter_id',
                    'token_setting.user_id',
                    DB::raw('CONCAT(user.firstname ," " ,user.lastname) AS officer')

                    )
                ->join('department', 'department.id', '=', 'token_setting.department_id')
                ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
                ->join('user', 'user.id', '=', 'token_setting.user_id')
                ->where('token_setting.status', 1)
                ->groupBy('token_setting.department_id')
                ->get(); 
        }

        return view('pages.token.auto', compact('display', 'departmentList', 'keyList'));
    }    

    public function tokenAuto(Request $request)
    {   
        @date_default_timezone_set(session('app.timezone'));
        
        $display = DisplaySetting::first();

        if ($display->sms_alert)
        {
            $validator = Validator::make($request->all(), [
                'client_mobile' => 'required',
                'department_id' => 'required|max:11',
                'counter_id'    => 'required|max:11',
                'user_id'       => 'required|max:11',
                'note'          => 'max:512' 
            ])
            ->setAttributeNames(array( 
               'client_mobile' => trans('app.client_mobile'),
               'department_id' => trans('app.department'),
               'counter_id' => trans('app.counter'),
               'user_id' => trans('app.officer'), 
               'note' => trans('app.note') 
            )); 
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'department_id' => 'required|max:11',
                'counter_id'    => 'required|max:11',
                'user_id'       => 'required|max:11',
                'note'          => 'max:512'
            ])
            ->setAttributeNames(array( 
               'department_id' => trans('app.department'),
               'counter_id' => trans('app.counter'),
               'user_id' => trans('app.officer'), 
               'note' => trans('app.note')
            )); 
        }

        //generate a token
        try {
            DB::beginTransaction(); 

            if ($validator->fails()) {
                $data['status'] = false;
                $data['exception'] = "<ul class='list-unstyled'>"; 
                $messages = $validator->messages();
                foreach ($messages->all('<li>:message</li>') as $message)
                {
                    $data['exception'] .= $message; 
                }
                $data['exception'] .= "</ul>"; 
            } else {  

                //find auto-setting
                $settings = TokenSetting::select('counter_id','department_id','user_id','created_at')
                        ->where('department_id', $request->department_id)
                        ->groupBy('user_id')
                        ->get();

                //if auto-setting are available
                if (!empty($settings)) { 

                    foreach ($settings as $setting) {
                        //compare each user in today
                        $tokenData = Token::select('department_id','counter_id','user_id',DB::raw('COUNT(user_id) AS total_tokens'))
                                ->where('department_id',$setting->department_id)
                                ->where('counter_id',$setting->counter_id)
                                ->where('user_id',$setting->user_id)
                                ->where('status', 0)
                                ->whereRaw('DATE(created_at) = CURDATE()')
                                ->orderBy('total_tokens', 'asc')
                                ->groupBy('user_id')
                                ->first(); 

                        //create user counter list
                        $tokenAssignTo[] = [
                            'total_tokens'  => (!empty($tokenData->total_tokens)?$tokenData->total_tokens:0),
                            'department_id' => $setting->department_id,
                            'counter_id'    => $setting->counter_id,
                            'user_id'       => $setting->user_id
                        ]; 
                    }

                    //findout min counter set to 
                    $min = min($tokenAssignTo);
                    $saveToken = [
                        'token_no'      => (new Token_lib)->newToken($min['department_id'], $min['counter_id']),
                        'client_mobile' => $request->client_mobile,
                        'department_id' => $min['department_id'],
                        'counter_id'    => $min['counter_id'],
                        'user_id'       => $min['user_id'],
                        'note'          => $request->note, 
                        'created_by'    => auth()->user()->id,
                        'created_at'    => date('Y-m-d H:i:s'), 
                        'updated_at'    => null,
                        'status'        => 0 
                    ]; 

                } else {
                    $saveToken = [
                        'token_no'      => (new Token_lib)->newToken($request->department_id, $request->counter_id),
                        'client_mobile' => $request->client_mobile,
                        'department_id' => $request->department_id,
                        'counter_id'    => $request->counter_id, 
                        'user_id'       => $request->user_id, 
                        'note'          => $request->note, 
                        'created_at'    => date('Y-m-d H:i:s'),
                        'created_by'    => auth()->user()->id,
                        'updated_at'    => null,
                        'status'        => 0
                    ];               
                }  

                //store in database  
                //set message and redirect
                if ($insert_id = Token::insertGetId($saveToken)) { 

                    $token = null;
                    //retrive token info
                    $token = Token::select(
                            'token.*', 
                            'department.name as department', 
                            'counter.name as counter', 
                            'user.firstname', 
                            'user.lastname'
                        )
                        ->leftJoin('department', 'token.department_id', '=', 'department.id')
                        ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                        ->leftJoin('user', 'token.user_id', '=', 'user.id') 
                        ->where('token.id', $insert_id)
                        ->first(); 

                    DB::commit();
                    $data['status'] = true;
                    $data['message'] = trans('app.token_generate_successfully');
                    $data['token']  = $token;
                    
                } else {
                    $data['status'] = false;
                    $data['exception'] = trans('app.please_try_again');
                }
            }
            
            return response()->json($data);
            
        } catch(\Exception $err) {
            DB::rollBack(); 
        }
    } 

    public function clientTokenAuto(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $display = DisplaySetting::first();

        $client_id = auth()->user()->id;
        $client_mobile = auth()->user()->mobile;

        //generate a token
        try {
            DB::beginTransaction();

            //find auto-setting
            $settings = TokenSetting::select('counter_id', 'department_id', 'user_id', 'created_at')
                ->where('department_id', $request->department_id)
                ->groupBy('user_id')
                ->get();

            // echo '<pre>';
            // print_r($settings->department_id);
            // echo '<pre>';
            // die();
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

                //  echo '<pre>';
                // print_r($tokenAssignTo);
                // echo '<pre>';
                // die();

                //findout min counter set to 
                $min = min($tokenAssignTo);
                $saveToken = [
                    'token_no'      => (new Token_lib)->newToken($min['department_id'], $min['counter_id']),
                    'location_id'   => $request->location,
                    'client_mobile' => $client_mobile,
                    'client_id'     => $client_id,
                    'department_id' => $min['department_id'],
                    'counter_id'    => $min['counter_id'],
                    'user_id'       => $min['user_id'],
                    'note'          => ($request->note != "")?$request->note:null,
                    'created_by'    => auth()->user()->id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => null,
                    'status'        => 3 //booked
                ];


                //store in database  
                //set message and redirect
                if ($insert_id = Token::insertGetId($saveToken)) {

                    $token = null;
                    //retrive token info
                    $token = Token::select(
                        'token.*',
                        'department.name as department',
                        'counter.name as counter',
                        'user.firstname',
                        'user.lastname'
                    )
                        ->leftJoin('department', 'token.department_id', '=', 'department.id')
                        ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                        ->leftJoin('user', 'token.user_id', '=', 'user.id')
                        ->where('token.id', $insert_id)
                        ->first();

                    DB::commit();

                    $list = Token::where('status', 0)
                        ->where('department_id', $saveToken["department_id"])
                        ->where('counter_id', $saveToken["counter_id"])
                        ->orderBy('id')->get();
                    $cntr = 1;
                    foreach ($list as $value) {
                        if ($value->token_no == $saveToken["token_no"]) {
                            break;
                        }
                        $cntr++;
                    }
                    $data['status'] = true;
                    $data['message'] = trans('app.token_generate_successfully');
                    $data['token']  = $token;
                    $data['position']  = $cntr;

                    activity('activity')
                    ->withProperties(['activity' => 'Client Generate Token','department' => $token->department , 'token' => $token->token_no , 'display'=> 'success']) 
                    ->log('Token (:properties.token) generated for :properties.department');

                } else {
                    $data['status'] = false;
                    $data['exception'] = trans('app.please_try_again');
                }

   
    
                return response()->json($data);
            }
        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json($err->getMessage());
        }
    }
 
    /*-----------------------------------
    | FORCE/MANUAL/VIP TOKEN 
    |-----------------------------------*/

    public function showForm()
    {  
        $display = DisplaySetting::first();
        $counters = Counter::where('status',1)->pluck('name','id');
        $departments = Department::where('status',1)->pluck('name','id');
        $officers = User::select(DB::raw('CONCAT(firstname, " ", lastname) as name'), 'id')
            ->where('user_type',1)
            ->where('status',1)
            ->orderBy('firstname', 'ASC')
            ->pluck('name', 'id'); 

        return view('pages.token.manual', compact('display', 'counters', 'departments','officers' ));
    }  

    public function create(Request $request)
    {  
        @date_default_timezone_set(session('app.timezone'));
        
        $display = DisplaySetting::first();

        if ($display->sms_alert)
        {
            $validator = Validator::make($request->all(), [
                'client_mobile' => 'required',
                'department_id' => 'required|max:11',
                'counter_id'    => 'required|max:11',
                'user_id'       => 'required|max:11',
                'note'          => 'max:512',
                'is_vip'        => 'max:1'
            ])
            ->setAttributeNames(array(
               'client_mobile' => trans('app.client_mobile'),
               'department_id' => trans('app.department'),
               'counter_id'    => trans('app.counter'),
               'user_id'       => trans('app.officer'), 
               'note'          => trans('app.note'),
               'is_vip'        => trans('app.is_vip'), 
            ));  
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'department_id' => 'required|max:11',
                'counter_id'    => 'required|max:11',
                'user_id'       => 'required|max:11',
                'note'          => 'max:512',
                'is_vip'        => 'max:1'
            ])
            ->setAttributeNames(array( 
               'department_id' => trans('app.department'),
               'counter_id'    => trans('app.counter'),
               'user_id'       => trans('app.officer'),
               'note'          => trans('app.note'),
               'is_vip'        => trans('app.is_vip'), 
            )); 
        }

        if ($validator->fails()) 
        {
            $data['status'] = false;
            $data['exception'] = "<ul class='list-unstyled'>"; 
            $messages = $validator->messages();
            foreach ($messages->all('<li>:message</li>') as $message)
            {
                $data['exception'] .= $message; 
            }
            $data['exception'] .= "</ul>"; 
        } 
        else 
        { 
            $newTokenNo = (new Token_lib)->newToken($request->department_id, $request->counter_id, $request->is_vip);

            $save = Token::insert([
                'token_no'      => $newTokenNo,
                'client_mobile' => $request->client_mobile,
                'department_id' => $request->department_id,
                'counter_id'    => $request->counter_id, 
                'user_id'       => $request->user_id, 
                'note'          => $request->note, 
                'created_by'    => auth()->user()->id,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => null,
                'is_vip'        => $request->is_vip, 
                'status'        => 0 
            ]);

            if ($save) { 
                $token = Token::select(
                    'token.*', 
                    'department.name as department', 
                    'counter.name as counter', 
                    'user.firstname', 
                    'user.lastname'
                )
                ->leftJoin('department', 'token.department_id', '=', 'department.id')
                ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
                ->leftJoin('user', 'token.user_id', '=', 'user.id')
                ->whereDate('token.created_at', date("Y-m-d"))
                ->where('token.token_no', $newTokenNo)
                ->first(); 

                $data['status'] = true;
                $data['message'] = trans('app.token_generate_successfully');
                $data['token']  = $token;
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        return response()->json($data);
    } 
 
    /*-----------------------------------
    | TOKEN CURRENT / REPORT / PERFORMANCE
    |-----------------------------------*/

    public function _current()
    {  
        @date_default_timezone_set(session('app.timezone'));
        $tokens = Token::where('status', '0')
        ->orderBy('is_vip', 'DESC')
        ->orderBy('id', 'ASC')
        ->get(); 
    
        $counters = Counter::where('status',1)->pluck('name','id');
        $departments = Department::where('status',1)->pluck('name','id');
        $officers = User::select(DB::raw('CONCAT(firstname, " ", lastname) as name'), 'id')
            ->where('user_type',1)
            ->where('status',1)
            ->orderBy('firstname', 'ASC')
            ->pluck('name', 'id'); 
                    
        return view('pages.token.current', compact('counters', 'departments', 'officers', 'tokens'));
    } 

    public function current(TokenDataTable $dataTable)
    {        
        @date_default_timezone_set(session('app.timezone'));
        $waiting = Token::where('status', '0')->count();
        $counters = Counter::where('status',1)->pluck('name','id');
        $departments = Department::where('status',1)->pluck('name','id');
        $officers = User::select('id',DB::raw('CONCAT(firstname, " ", lastname) as full_name'))
            ->where('user_type',1)
            ->where('status',1)
            ->orderBy('full_name', 'ASC')
            ->pluck('full_name', 'id');  
        
        return $dataTable->render('pages.token.current', compact('counters', 'departments', 'officers', 'waiting'));
    }

    public function currentOfficer()
    {       
        @date_default_timezone_set(session('app.timezone'));
        $tokens = Token::where('status', '0')
            ->where('user_id', auth()->user()->id )
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->get(); 

        return view('pages.token.current-icons', compact('tokens'));
    } 

    public function report(Request $request)
    {  
        @date_default_timezone_set(session('app.timezone'));
        $counters = Counter::where('status',1)->pluck('name','id');
        $departments = Department::where('status',1)->pluck('name','id');
        $officers = User::select('id',DB::raw('CONCAT(firstname, " ", lastname) as full_name'))
            ->where('user_type',1)
            ->where('status',1)
            ->orderBy('full_name', 'ASC')
            ->pluck('full_name', 'id'); 

        return view('pages.token.report', compact('counters', 'departments', 'officers'));
    }  

    public function reportData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'token_no',
            2 => 'department_id',
            3 => 'counter_id',
            4 => 'user_id',
            5 => 'client_mobile',
            6 => 'note',
            7 => 'status',
            8 => 'created_by',
            9 => 'created_at',
            10 => 'updated_at',
            11 => 'updated_at',
            12 => 'id',
        ]; 

        $totalData = Token::count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir'); 
        $search = $request->input('search'); 
            
        if(empty($search))
        {            
            $tokens = Token::offset($start)
                 ->limit($limit)
                 ->orderBy($order,$dir)
                 ->get();
        }
        else 
        { 
            $tokensProccess = Token::where(function($query)  use($search) {

                    if (!empty($search['status'])) {
                        $query->where('status', '=', $search['status']);
                    }
                    if (!empty($search['counter'])) {
                        $query->where('counter_id', '=', $search['counter']);
                    }
                    if (!empty($search['department'])) {
                        $query->where('department_id', '=', $search['department']);
                    }
                    if (!empty($search['officer'])) {
                        $query->where('user_id', '=', $search['officer']);
                    }

                    if (!empty($search['start_date']) && !empty($search['end_date'])) {
                        $query->whereBetween("created_at",[
                            date('Y-m-d', strtotime($search['start_date']))." 00:00:00", 
                            date('Y-m-d', strtotime($search['end_date']))." 23:59:59"
                        ]);
                    }
 
                    if (!empty($search['value'])) {

                        if ((strtolower($search['value']))=='vip') 
                        {
                            $query->where('is_vip', '1');
                        }
                        else
                        {
                            $date = date('Y-m-d', strtotime($search['value']));
                            $query->where('token_no', 'LIKE',"%{$search['value']}%")
                                ->orWhere('client_mobile', 'LIKE',"%{$search['value']}%")
                                ->orWhere('note', 'LIKE',"%{$search['value']}%")
                                ->orWhere(function($query)  use($date) {
                                    $query->whereDate('created_at', 'LIKE',"%{$date}%");
                                })
                                ->orWhere(function($query)  use($date) {
                                    $query->whereDate('updated_at', 'LIKE',"%{$date}%");
                                })
                                ->orWhereHas('generated_by', function($query) use($search) {
                                    $query->where(DB::raw('CONCAT(firstname, " ", lastname)'), 'LIKE',"%{$search['value']}%");
                                }); 
                        }
                    }
                });

            $totalFiltered = $tokensProccess->count();
            $tokens = $tokensProccess->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get(); 

        }

        $data = array();
        if(!empty($tokens))
        {
            $loop = 1;
            foreach ($tokens as $token)
            {  
                # complete time calculation
                $complete_time = "";
                if (!empty($token->updated_at)) {  
                    $date1 = new \DateTime($token->created_at); 
                    $date2 = new \DateTime($token->updated_at); 
                    $diff  = $date2->diff($date1); 
                    $complete_time = (($diff->d > 0) ? " $diff->d Days " : null) . "$diff->h hrs $diff->i mins ";
                }

                //load options via render
                $options = view('pages.token._report-menu', compact('token'))->render();

                switch ($token->status) {
                    case 0:
                        $color  = 'badge-light-primary';
                        $bg     = 'bg-primary';
                        $txt    = trans('app.pending');
                        break;
                    case 1:
                        $color = 'badge-light-success';
                        $bg     = 'bg-success';
                        $txt    = trans('app.complete');
                        break;
                    case 2:
                        $color = 'badge-light-danger';
                        $bg     = 'bg-danger';
                        $txt    = trans('app.stop');
                        break;
                    case 3:
                        $color = 'badge-light-warning';
                        $bg     = 'bg-warning';
                        $txt    = 'Booked';
                        break;
                    default:
                        $color = 'badge-light-danger';

                        break;
                }

                $color = (!empty($token->is_vip)) ? 'bg-danger' : $color;

                $data[] = [
                    'serial'     => $loop++,
                    'token_no'   => "<div class=\"badge $color fw-bolder\" data-vip=\"$token->is_vip\" data-id=\"$token->token_no\">$token->token_no</div>".'<input type=hidden name=notes value='.$token->note.'><input type=hidden name=off_notes value='.$token->officer_note.'>',
                    'department' => (!empty($token->department)?$token->department->name:null),
                    'counter'    => (!empty($token->counter)?$token->counter->name:null),
                    'officer'    => (!empty($token->officer)?("<a href='".url("user/view/{$token->officer->id}")."'>".$token->officer->firstname." ". $token->officer->lastname."</a>"):null),

                    'client_mobile' => $token->client_mobile,

                    'note'          => $token->note,
                    'status'        => "<span class='badge ".$bg." text-white'>".$txt."</span>",
                    'created_by'    => (!empty($token->generated_by)?("<a href='".url("user/view/{$token->generated_by->id}")."'>".$token->generated_by->firstname." ". $token->generated_by->lastname."</a>"):null),
                    'created_at'    => (!empty($token->created_at)?date('j M Y h:i a',strtotime($token->created_at)):null),
                    'updated_at'    => (!empty($token->updated_at)?date('j M Y h:i a',strtotime($token->updated_at)):null),
                    'complete_time' => $complete_time,
                    'options'       => $options,
                    'token_id'      => $token->id,
                    'department_id' => $token->department->id,
                    'counter_id'    => $token->counter->id,
                    'officer_id'    => (!empty($token->officer) ? $token->officer->id : 0),
                    'officer_note'  => $token->officer_note,

                ];  
            }
        }
            
        return response()->json([
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ]);
    }

    public function performance(Request $request)
    { 
        @date_default_timezone_set(session('app.timezone'));
        
        $report = (object)array(
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date 
        );

        //REPORT DATA PROCESSING...
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date   = date('Y-m-d', strtotime($request->end_date)); 
    
        $tokens = DB::select("
         SELECT 
            realToken.user_id AS uid,
          (SELECT CONCAT_WS(' ', firstname, lastname) FROM user WHERE id= realToken.user_id) as officer,
          (
            SELECT COUNT(id) 
            FROM token 
            WHERE 
                user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')
          ) AS total,
          
          (
            SELECT COUNT(id) 
            FROM token 
            WHERE 
                status = 2 
                AND user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')
          ) AS stoped,
          (
            SELECT COUNT(id) 
            FROM token 
            WHERE 
                status = 1 
                AND user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')
          ) AS success,
          (
            SELECT COUNT(id)
            FROM token 
            WHERE 
                status = 0 
                AND user_id=realToken.user_id
                AND (DATE(created_at) BETWEEN '".$start_date."' AND '".$end_date."')
          ) AS pending
          FROM 
            token AS realToken
          GROUP BY user_id
        ");
        //ENDS OF REPORT DATA PROCESSING...

        return view('pages.token.performance', compact(  'report','tokens'));
    }


    /*-----------------------------------
    | VIEW / RECALL / COMPLETE / STOPED / DELETE 
    |-----------------------------------*/

    public function viewSingleToken(Request $request)
    {
        return Token::select('token.*', 'department.name as department', 'counter.name as counter', 'user.firstname', 'user.lastname', 'location.name as location')
            ->leftJoin('locations', 'token.location_id', '=', 'locations.id')
            ->leftJoin('department', 'token.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token.counter_id', '=', 'counter.id')
            ->leftJoin('user', 'token.user_id', '=', 'user.id')
            ->where('token.id', $request->id)
            ->first(); 
    }

    public function recall($id = null)
    {
        @date_default_timezone_set(session('app.timezone')); 
        
        //send sms immediately
        $setting  = SmsSetting::first(); 
        $token = DB::table('token AS t')
            ->select(
                "t.token_no AS token",
                "t.client_mobile AS mobile",
                "d.name AS department",
                "c.name AS counter",
                DB::raw("CONCAT_WS(' ', u.firstname, u.lastname) AS officer"),
                "t.created_at AS date" 
            )
            ->leftJoin('department AS d', 'd.id', '=', 't.department_id')
            ->leftJoin('counter AS c', 'c.id', '=', 't.counter_id')
            ->leftJoin('user AS u', 'u.id', '=', 't.user_id')
            ->where('t.id', $id)
            ->first();

        if (!empty($token->mobile))
        {
            $response = (new SMS_lib)
                ->provider("$setting->provider")
                ->api_key("$setting->api_key")
                ->username("$setting->username")
                ->password("$setting->password")
                ->from("$setting->from")
                ->to($token->mobile)
                ->message($setting->recall_sms_template, array(
                    'TOKEN'  =>$token->token,
                    'MOBILE' =>$token->mobile,
                    'DEPARTMENT'=>$token->department,
                    'COUNTER'=>$token->counter,
                    'OFFICER'=>$token->officer,
                    'DATE'   =>$token->date
                ))
                ->response();
            $api = json_decode($response, true); 

            //store sms information 
            $sms = new SmsHistory; 
            $sms->from        = $setting->from;
            $sms->to          = $token->mobile;
            $sms->message     = $api['message'];
            $sms->response    = $response;
            $sms->created_at  = date('Y-m-d H:i:s');
            $sms->save();
        }
        
        Token::where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'), 
                'status'     => 0,
                'sms_status' => 2
            ]);

        //RECALL 
        return redirect()->back()->with('message', trans('app.recall_successfully'));
    } 

    public function complete($id = null)
    {
        @date_default_timezone_set(session('app.timezone'));
        
        Token::where('id', $id)->update(['updated_at' => date('Y-m-d H:i:s'), 'status' => 1, 'sms_status' => 1]);
        return redirect()->back()->with('message', trans('app.complete_successfully'));
    } 

    public function stoped($id = null)
    { 
        Token::where('id', $id)->update(['updated_at' => null, 'status' => 2,'sms_status' => 1]);
        $token = Token::where('id', $id)->first();
        activity('activity')
                    ->withProperties(['activity' => 'Client Stopped Token','department' => $token->department->name , 'token' => $token->token_no , 'display'=> 'danger']) 
                    ->log('Token (:properties.token) stopped for :properties.department');

        return redirect()->back()->with('message', trans('app.update_successfully'));
    } 

    public function noshow($id = null)
    { 
        @date_default_timezone_set(session('app.timezone'));
        
        Token::where('id', $id)->update(['updated_at' => date('Y-m-d H:i:s'), 'status' => 2,'sms_status' => 1, 'no_show' => 1]);
        $token = Token::where('id', $id)->first();
        activity('activity')
                    ->withProperties(['activity' => 'Staff Cancelled Token','department' => $token->department->name , 'token' => $token->token_no , 'display'=> 'danger']) 
                    ->log('Token (:properties.token) cancelled for :properties.department');

        return redirect()->back()->with('message', trans('app.update_successfully'));
    }

    public function start($id = null)
    { 
        @date_default_timezone_set(session('app.timezone'));
        
        Token::where('id', $id)->update(['started_at' => date('Y-m-d H:i:s'), 'status' => 0]);
        $token = Token::where('id', $id)->first();
        activity('activity')
                    ->withProperties(['activity' => 'Now Serving Token','department' => $token->department->name , 'token' => $token->token_no , 'display'=> 'info']) 
                    ->log('Token (:properties.token) started for :properties.department');

        return redirect()->back()->with('message', trans('app.update_successfully'));
    } 

    public function transfer(Request $request)
    {
        // transfer token
        $validator = Validator::make($request->all(), [
            'id'            => 'required|max:11',
            'department_id' => 'required|max:11',
            'counter_id'    => 'required|max:11',
            'user_id'       => 'required|max:11' 
        ])
        ->setAttributeNames(array( 
           'id'            => trans('app.token'),
           'department_id' => trans('app.department'),
           'counter_id'    => trans('app.counter'),
           'user_id'       => trans('app.officer') 
        )); 

        if ($validator->fails()) 
        {
            $data['status'] = false;
            $data['exception'] = "<ul class='list-unstyled'>"; 
            $messages = $validator->messages();
            foreach ($messages->all('<li>:message</li>') as $message)
            {
                $data['exception'] .= $message; 
            }
            $data['exception'] .= "</ul>"; 
        } 
        else 
        { 
            $update = Token::where('id', $request->id)
            ->update([
                'department_id' => $request->department_id,
                'counter_id'    => $request->counter_id, 
                'user_id'       => $request->user_id, 
                'is_vip'        => $request->is_vip, 
                'officer_note'  => $request->officer_note, 
            ]);

            if ($update) 
            {  
                $data['status'] = true;
                $data['message'] = trans('app.token_transfered_successfully');
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }
        }
        
        return response()->json($data);
    }

    public function delete($id = null)
    { 
        Token::where('id', $id)->delete();
        return redirect()->back()->with('message', trans('app.delete_successfully'));
    }
    
    public function addnote(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $update = Token::where('id', $request->id)
            ->update([
                'officer_note'  => $request->officer_note, 
            ]);
            if ($update) 
            {  
                $data['status'] = true;
                $data['message'] = trans('app.note_added_successfully');
            } else {
                $data['status'] = false;
                $data['exception'] = trans('app.please_try_again');
            }

        return response()->json($data);

    } 


     /*-----------------------------------
    | TOKEN CURRENT / REPORT / PERFORMANCE
    |-----------------------------------*/

    public function currentClient()
    {
        @date_default_timezone_set(session('app.timezone'));
        $token = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();

    
        if (!$token) {
            return redirect('home');
        }

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', [0, 3])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('id')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        $waittime = $dept->avg_wait_time * ($cntr - 1);
        
        $position = $cntr;
        $wait = date('H:i', mktime(0, $waittime));

        return view('pages.home.current', compact('token','position','wait'));
    }

    public function currentposition()
    {
        $token = Token::whereIn('status', ['0', '3'])
            ->where('client_id', auth()->user()->id)
            ->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC')
            ->first();

        $dept = Department::find($token->department_id);

        $list = Token::whereIn('status', ['0', '3'])
            ->where('department_id', $token->department_id)
            ->where('counter_id', $token->counter_id)
            ->orderBy('id')->get();
        $cntr = 1;
        foreach ($list as $value) {
            if ($value->token_no == $token->token_no) {
                break;
            }
            $cntr++;
        }

        $waittime = $dept->avg_wait_time * ($cntr - 1);
        $data['status'] = true;
        $data['position'] = $cntr;
        $data['wait'] = date('H:i', mktime(0, $waittime));

        return response()->json($data);
    }

    public function checkin($id = null)
    {
        Token::where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'), 
                'status'     => 0,
                'sms_status' => 1
            ]);

        $data['status'] = true;
        $data['exception'] = trans('app.update_successfully');

        $token = Token::where('id', $id)->first();
        activity('activity')
                    ->withProperties(['activity' => 'Client Checked In Token' , 'department' => $token->department->name , 'token' => $token->token_no , 'display' => 'primary' ]) 
                    ->log('Token :properties.token checked in for :properties.department');

        return response()->json($data);        
    }

    public function stopedClient($id)
    {
        Token::where('id', $id)
            ->where('client_id', auth()->user()->id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status'     => 2,
                'sms_status' => 1
            ]);

        $token = Token::where('id', $id)->get();

        $data['status'] = true;
        $data['exception'] = trans('app.update_successfully');

        $token = Token::where('id', $id)->first();
        activity('activity')
                    ->withProperties(['activity' => 'Client Stopped Token','department' => $token->department->name , 'token' => $token->token_no , 'display'=> 'danger' ]) 
                    ->log('Token (:properties.token) stopped for :properties.department');


        return response()->json($data);
    }

}

 