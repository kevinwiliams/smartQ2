<?php

namespace App\Http\Controllers\Admin;

use App\Core\Data;
use App\DataTables\Location\LocationDataTable;
use App\DataTables\Department\DepartmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Counter;
use App\Models\DisplaySetting;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DataTables, DB;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LocationDataTable $dataTable)
    {

        if (!auth()->user()->can('view location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        if (auth()->user()->can('choose location')) {
            $company = auth()->user()->location->company;
            $companies = Company::where('active', 1)->pluck('name', 'id');

            $markers = array();
            $infowindows = array();

            foreach ($company->locations as $_location) {
                array_push($markers, array($_location->name, $_location->lat, $_location->lon));
                array_push($infowindows, array($_location->name, $_location->address));
            }

            // echo '<pre>';
            // print_r($company);
            // echo '</pre>';
            // die();
            return $dataTable->render('pages.location.list', compact('company', 'markers', 'infowindows'));
        } else {
            return Redirect::to("/location/view/" . auth()->user()->location_id);
        }
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
        if (!auth()->user()->can('create location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:locations,name|max:50',
            'address'      => 'required',
            'company_id'      => 'required',
            'lat'      => 'required',
            'lng'      => 'required'
        ])
            ->setAttributeNames(array(
                'company_id' => trans('app.company'),
                'name' => trans('app.name'),
                'address' => trans('app.address'),
                'lat' => trans('app.lat'),
                'lng' => trans('app.lng'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {

            ///Generate: default location
            $location = Location::create([
                'company_id' => $request->company_id,
                'name'  => $request->name,
                'address' =>  $request->address,
                'lat' => $request->lat,
                'lon' => $request->lng,
                'active' => ($request->has('active')) ? 1 : 0
            ]);

            if ($location) {
                ///Generate: default display settings
                $displaysettings = Data::getDefaultDisplay();
                $displaysettings['location_id'] = $location->id;
                $display = DisplaySetting::insert($displaysettings);


                $data['status'] = true;
                $data['data'] = $location;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        if (!auth()->user()->can('view location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)
            ->withCount('visitorslastweek')
            ->first();
        $visitor_summary = $this->chart_visitor_summary($id);
        $biannual = $this->chart_biannual($id);

        // echo '<pre>';
        // print_r($officers->count());
        // echo '</pre>';
        // die();

        return view('pages.location.view', compact('location', 'departments', 'counters', 'officers', 'visitor_summary', 'biannual'));
    }

    public function showEditForm($id = null)
    {
        if (!auth()->user()->can('edit location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)
            ->withCount('visitorslastweek')
            ->first();

        // echo '<pre>';
        // print_r($officers->count());
        // echo '</pre>';
        // die();

        return view('pages.location.edit', compact('location', 'departments', 'counters', 'officers'));
    }

    public function map($id = null)
    {
        if (!auth()->user()->can('view location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('user_type', '<>', 3)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)
            ->withCount('visitorslastweek')
            ->first();

        // echo '<pre>';
        // print_r($location->visitorslastweek()->count());
        // echo '</pre>';
        // die();

        return view('pages.location.map', compact('location', 'departments', 'counters', 'officers'));
    }

    public function dept($id = null, DepartmentDataTable $dataTable)
    {
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
            ->where('status', 1)
            ->get();
        // ->count();
        $location = Location::where('id', $id)->first();

        $keyList = $this->keyList();

        $model = Department::query();


        return $dataTable->with('deptlocation_id', $id)->render('pages.location.departments', compact('keyList', 'location', 'departments', 'counters', 'officers'));
    }

    public function keyList()
    {
        $chars = array_merge(range('1', '9'), range('a', 'z'));
        $list = array();
        foreach ($chars as $char) {
            if ($char != "v")
                $list[$char] = $char;
        }
        return $list;
    }

    //chart month wise token
    public function chart_visitor_summary($id)
    {
        return DB::select(DB::raw("
        select 
            count(case when status = 0 then 1 end) as active,
            count(case when status = 1 then 1 end) as complete,
            count(case when status = 2 then 1 end) as no_show,
            count(case when status = 3 then 1 end) as booked,
            count(id) as total
        from token
            where location_id = $id
        "));
    }

    //chart year wise token
    public function chart_biannual($id)
    {
        return DB::select(DB::raw("
            SELECT 
                DATE_FORMAT(created_at, '%b') AS month,
                COUNT(CASE WHEN status = 1 THEN 1 END) as complete,
                COUNT(CASE WHEN status = 2 THEN 1 END) as no_show,
                COUNT(t.id) AS total
            FROM 
                token AS t
            WHERE  
                #YEAR(created_at) >= YEAR(CURRENT_DATE()) 
                created_at > DATE_SUB(now(), INTERVAL 6 MONTH)
                AND location_id = $id
            GROUP BY 
                month
            ORDER BY 
                t.created_at ASC
        "));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }
    public function printqr($id)
    {
        $content = "<div>";
        $content .=  QrCode::style('round')->eyeColor(0, 0, 178, 0, 1, 162, 217)->size(500)->color(1, 162, 217)->generate($id);
        $content .= "</div>";

        return PDF::loadHtml($content)->inline('qrcode-' . $id . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('create location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }

        @date_default_timezone_set(session('app.timezone'));
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:locations,name,' . $id . '|max:50',
            'address'      => 'required',
            'company_id'      => 'required',
            'lat'      => 'required',
            'lon'      => 'required'
        ])
            ->setAttributeNames(array(
                'company_id' => trans('app.company'),
                'name' => trans('app.name'),
                'address' => trans('app.address'),
                'lat' => trans('app.lat'),
                'lon' => trans('app.lng'),
            ));

        if ($validator->fails()) {
            $data['status'] = true;
            $data['error'] = $validator;
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {
            $update = Location::where('id', $id)
                ->update([
                    'company_id' => $request->company_id,
                    'name'  => $request->name,
                    'address' =>  $request->address,
                    'lat' => $request->lat,
                    'lon' => $request->lon,
                    'active' => ($request->has('active')) ? 1 : 0
                ]);

            if ($update) {
                $data['status'] = true;
                $data['data'] = $update;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }

    public function getBusyHours(Request $request)
    {

        if (empty($request->location_id))
            return response()->json([], 400);

        $start = Carbon::now()->subDays(60);
        $end = Carbon::now();
        $data = (object)array();
        $seriesdata = array();
        // $colordata = array();
        // $gdata = array();
        $info = DB::table("token")
            ->select(DB::raw("    
    COUNT(token.`created_at`) AS 'total', 
    HOUR(token.`created_at`) AS 'hour', 
    DAYNAME(token.`created_at`) AS 'day'
    "))
            ->join('locations', 'locations.id', '=', 'token.location_id')
            ->where('location_id', $request->location_id)
            ->whereRaw("DAYNAME(token.`created_at`) = '$request->weekday'")
            ->whereBetween('token.created_at', [$start, $end])
            ->whereRaw("HOUR(token.`created_at`) >=8 and  HOUR(token.`created_at`) <= 20")
            ->groupByRaw('DAYNAME(token.`created_at`),HOUR(token.`created_at`)')
            ->orderByRaw('hour')
            ->get();

        $maxarray = $info->pluck('total')->toArray();

        $maxnum = (!empty($maxarray)) ? max($maxarray) : 0;

        for ($i = 8; $i < 21; $i++) {
            $record = $info->where('hour', $i)->first();

            $y = 0;
            if ($record)
                $y = $record->total;


            $ismax = ($maxnum == $y);
            // array_push($colordata, ($ismax) ? "#f1416c" : "#009ef7");
            // $tmp = (object)array();
            // $tmp->stroke = 'blue';
            // $tmp->fill = 'blue';
            array_push($seriesdata, array('x' => date('g a', mktime($i, 0)), 'y' => $y, 'fillColor' => ($ismax) ? "#f1416c" : "#009ef7"));
        }

        $data->data = $seriesdata;
        // $data->colordata = $colordata;
        ///Insert missing series values
        return response()->json($data);
    }

    public function getData($id)
    {

        @date_default_timezone_set(session('app.timezone'));

        if ($id == null) {
            $data['status'] = false;
            $data['error'] = trans('app.validation_error');
            $data['message'] = trans('app.validation_error');

            return response()->json($data);
        } else {

            ///Generate: default location
            $location = Location::where('id', $id)->with(['openinghours', 'services', 'alerts'])->first();

            if ($location) {
                $data['status'] = true;
                $data['data'] = $location;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
            }


            return response()->json($data);
        }
    }
}
