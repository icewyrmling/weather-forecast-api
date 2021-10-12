<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models;
use DB;

class CityController extends Controller
{
    //

    public function index()
    {
        $data = DB::table('city')->orderBy('city_name', 'asc')->get();
        return response()->json([
            "cities" => $data
        ]);
    }
}
