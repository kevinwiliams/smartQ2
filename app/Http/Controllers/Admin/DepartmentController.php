<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Department\DepartmentDataTable;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Department;
use App\Models\Counter;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    
    public function _index()
    { 
        $departments = Department::get();
        return view('pages.location.department.list', compact('departments'));
    }

    public function index(DepartmentDataTable $dataTable, $id = null)
    {          
        if (!auth()->user()->can('view location')) {
            return Redirect::to("/")->withFail(trans('app.no_permissions'));
        }
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
                    ->where('status', 1)
                    ->get();
                    // ->count();
        $location = Location::where('id', $id)->first();

        $keyList = $this->keyList();

        $model = Department::query();
   
        
        return $dataTable->with('deptlocation_id', $id)->render('pages.location.department.list', compact('keyList', 'location','departments', 'counters', 'officers'));
    }

    public function showForm()
    {
        $keyList = $this->keyList();
        return view('pages.department.form', compact('keyList'));
    }
    
    public function create(Request $request)
    { 
        @date_default_timezone_set(session('app.timezone')); 
        $validator = Validator::make($request->all(), [
            'name'        => 'required|unique:department,name|max:50',
            'description' => 'max:255',
            'key'         => 'required|unique:department,key|max:1',
            'status'      => 'required',
            'avg_wait_time'      => 'required',
        ])
        ->setAttributeNames(array(
           'name' => trans('app.name'),
           'description' => trans('app.description'),
           'key' => trans('app.key_for_keyboard_mode'),
           'status' => trans('app.status'),
           'avg_wait_time' => trans('app.avg_wait_time')
        ));

        if ($validator->fails()) {
            return redirect('location/department/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $save = Department::insert([
                'name'        => $request->name,
                'description' => $request->description,
                'key'         => $request->key,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => null,
                'status'      => $request->status,
                'avg_wait_time'      => $request->avg_wait_time,
                'location_id' => $request->location_id,

            ]);

            if ($save) {
                $data['status'] = true;
                $data['message'] = trans('app.save_successfully');
                return response()->json($data);
            
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data);
            }

        }
    } 
 
    public function showEditForm($id = null)
    {
        $keyList = $this->keyList();
        $department = Department::where('id', $id)->first();
        return view('partials.modals.department._edit_fields', compact('department', 'keyList'));
    }


    public function update(Request $request)
    { 
        @date_default_timezone_set(session('app.timezone'));

        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:50|unique:department,name,'.$request->id,
            'description' => 'max:255',
            'key'         => 'required|max:1|unique:department,key,'.$request->id,
            'status'      => 'required',
            'avg_wait_time'      => 'required',
        ])
        ->setAttributeNames(array(
           'name' => trans('app.name'),
           'description' => trans('app.description'),
            'key' => trans('app.key_for_keyboard_mode'),
           'status' => trans('app.status'),
           'avg_wait_time' => trans('app.avg_wait_time')
        ));

        if ($validator->fails()) {
            return redirect('location/department/edit/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $update = Department::where('id',$request->id)
                ->update([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'key'         => $request->key,
                    'updated_at'  => date('Y-m-d H:i:s'),
                    'status'      => $request->status,
                    'avg_wait_time'      => $request->avg_wait_time
                ]);

            if ($update) {
                $data['status'] = true;
                $data['message'] = trans('app.save_successfully');
                return response()->json($data);
            
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data);
            }

        }
    }
 
    public function delete($id = null)
    {
        $delete = Department::where('id', $id)->delete();
        return redirect('department')->with('message', trans('app.delete_successfully'));
    } 
 
    public function keyList()
    {
        $chars = array_merge(range('1','9'), range('a','z'));
        $list = array();
        foreach($chars as $char)
        {
            if ($char != "v")
            $list[$char] = $char;
        }
        return $list;
    }
 
}
