<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Counter\CounterDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Models\Counter;
use App\Models\Department;
use App\Models\User;
use App\Models\Location;
use Validator, App;

class CounterController extends Controller
{
	public function _index()
	{   
        $counters = Counter::get();
    	return view('pages.counter.list', ['counters' => $counters]);
	}

    public function index(CounterDataTable $dataTable, $id = null)
    {          
        
        $departments = Department::where('location_id', $id)->count();
        $counters = Counter::where('location_id', $id)->count();
        $officers = User::where('location_id', $id)
                    ->where('status', 1)
                    ->get();
                    // ->count();
        $location = Location::where('id', $id)->first();

        return $dataTable->with('ctrlocation_id', $id)->render('pages.location.counter.list', compact('location','departments', 'counters', 'officers'));
    }

    public function showForm()
    {
    	return view('pages.counter.form');
    }
    
    public function create(Request $request)
    {     
        @date_default_timezone_set(session('app.timezone'));
        
        $validator = Validator::make($request->all(), [ 
            'description' => 'max:255',
            'status'      => 'required',
            'name'        => 'required|unique:counter,name|max:50',
        ])
        ->setAttributeNames(array(
           'name' => trans('app.name'),
           'description' => trans('app.description'),
           'status' => trans('app.status')
        ));

        if ($validator->fails()) {
            return redirect('location/counter/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
 
            $save = Counter::insert([
                'name'        => $request->name,
                'description' => $request->description,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => null,
                'status'      => $request->status
            ]);

        	if ($save) {
	            return back()->withInput()
                        ->with('message', trans('app.save_successfully'));
        	} else {
	            return back()->withInput()
                        ->with('exception', trans('app.please_try_again'));
        	}

        }
    }
 
    public function showEditForm($id = null)
    {
        $counter = Counter::where('id', $id)->first();
        return view('partials.modals.counter._edit_fields', compact('counter'));
    }
  
    public function update(Request $request)
    { 
        @date_default_timezone_set(session('app.timezone')); 

        $validator = Validator::make($request->all(), [ 
            'description' => 'max:255',
            'status'      => 'required',
            'name'        => 'required|max:50|unique:counter,name,'.$request->id,
        ])
        ->setAttributeNames(array(
           'name' => trans('app.name'),
           'description' => trans('app.description'),
           'status' => trans('app.status')
        ));

        if ($validator->fails()) {
            return redirect('counter/edit/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $update = Counter::where('id',$request->id)->update([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'updated_at'  => date('Y-m-d H:i:s'),
                    'status'      => $request->status
                ]);

            if ($update) {
                return back()
                        ->with('message', trans('app.update_successfully'));
            } else {
                return back()
                        ->with('exception', trans('app.please_try_again'));
            }

        }
    }
 
    public function delete($id = null)
    {
        $delete = Counter::where('id', $id)
            ->delete();
        return redirect('counter')->with('message', trans('app.delete_successfully'));
    }  
}
