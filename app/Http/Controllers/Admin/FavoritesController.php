<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function clientfaves()
    {
        return view('pages.location.clientfaves');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $location = Location::find($request->id);

        if (!$location) {
            $data['status'] = false;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {

            $exists = Favorites::where('location_id', $request->id)->where('user_id', auth()->user()->id)->first();
            if ($exists) {
                $data['status'] = false;
                $data['error'] = trans('app.fave_exists');
                $data['message'] = trans('app.fave_exists');

                return response()->json($data, 200);
            }
            $fave = Favorites::create([
                'location_id' => $request->id,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()
            ]);

            if ($fave) {
                $data['status'] = true;
                $data['message'] = trans('app.save_successfully');
            } else {
                $data['status'] = false;
                $data['message'] = trans('app.please_try_again');
                return response()->json($data, 400);
            }


            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorites  $favorites
     * @return \Illuminate\Http\Response
     */
    public function show(Favorites $favorites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorites  $favorites
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorites $favorites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorites  $favorites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorites $favorites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorites  $favorites
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorites $favorites)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorites  $favorites
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $location = Location::find($id);

        if (!$location) {
            $data['status'] = false;
            $data['message'] = trans('app.validation_error');

            return response()->json($data, 400);
        } else {

            $exists = Favorites::where('location_id', $id)->where('user_id', auth()->user()->id)->delete();

            $data['status'] = true;            
            $data['message'] = trans('app.delete_successfully');

            return response()->json($data, 200);
        }
    }
}
