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
use App\Models\TokenSetting;
use Illuminate\Support\Facades\Redirect;
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
        $location = Location::where('id', $id)->first();

        return $dataTable->with('ctrlocation_id', $id)->render('pages.location.counter.list', compact('location', 'departments', 'counters', 'officers'));
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
                'status'      => $request->status,
                'location_id' => $request->location_id

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
        $counter = Counter::where('id', $id)->first();
        return view('partials.modals.counter._edit_fields', compact('counter'));
    }

    public function getCountersbyDept($id)
    {
        $counters = TokenSetting::select('counter.id as id', 'counter.name as name')
            ->leftJoin('department', 'token_setting.department_id', '=', 'department.id')
            ->leftJoin('counter', 'token_setting.counter_id', '=', 'counter.id')
            ->where('token_setting.department_id', $id)
            ->where('token_setting.location_id', auth()->user()->location_id)
            ->orderBy('name')
            ->get();
        return response()->json($counters);
    }

    public function update(Request $request)
    {
        @date_default_timezone_set(session('app.timezone'));

        $validator = Validator::make($request->all(), [
            'description' => 'max:255',
            'status'      => 'required',
            'name'        => 'required|max:50|unique:counter,name,' . $request->id,
        ])
            ->setAttributeNames(array(
                'name' => trans('app.name'),
                'description' => trans('app.description'),
                'status' => trans('app.status')
            ));

        if ($validator->fails()) {
            return redirect('counter/edit/' . $request->id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $update = Counter::where('id', $request->id)->update([
                'name'        => $request->name,
                'description' => $request->description,
                'updated_at'  => date('Y-m-d H:i:s'),
                'status'      => $request->status
            ]);

            if ($update) {
                // return back()
                //         ->with('message', trans('app.update_successfully'));
                $data['status'] = true;
                $data['message'] = trans('app.update_successfully');
                return response()->json($data);
            } else {
                // return back()
                //         ->with('exception', trans('app.please_try_again'));
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data);
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
