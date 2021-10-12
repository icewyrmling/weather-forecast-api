<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models;
use DB;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userID = auth()->user()->id;
        $data = DB::table('cities_by_user')->where('user_id', $userID)->join('city', 'cities_by_user.city_id','=','city.city_id')->orderBy('city_name', 'asc')->get('city_name');
        return response()->json([
            "cities" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = auth()->user()->id;
        $cities = $request->cities;
        $count_cities = DB::table('cities_by_user')->where('user_id', $userID)->count();
        foreach ($cities as $city_id) {
            if($count_cities < 10){
                DB::table("cities_by_user")->insertOrIgnore([
                    "user_id" => $userID,
                    "city_id" => $city_id,
                ]);
            }
        }

        return response()->json([
            "cities" => $cities,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Http::get("url", [
            "apiKey" => env("WEATHER_APP_KEY"),
            "gradovi" => "Beograd",
        ]);
        return response()->json([
            "data" => $data,
        ]);
    }

    public function setTime(Request $request)
    {
        $userID = auth()->user()->id;
        DB::table("users")->where('id', $userID)->update([
            "mail_time" => $request->time,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $userID = auth()->user()->id;
        foreach ($request->cities as $city) {
            DB::table('cities_by_user')->where('user_id', $userID)->join('city','cities_by_user.city_id','=','city.city_id')->where('city_name', $city)->delete();
        }

        return response()->json([
            "data" => "uspesno obrisano",
        ]);
    }
}
