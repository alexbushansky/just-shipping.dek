<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoNameController extends Controller
{
    public function getCities($id)
    {
        $cities = DB::table('cities')->where('region_id',$id)->get();
        return response()->json([
            'cities' => $cities,
        ]);
    }

    public function getRegions($id)
    {
        $regions = DB::table('regions')->where('country_id',$id)->get();
        return response()->json([
            'regions' => $regions,
        ]);
    }

    public function getCountries()
    {
        $countries = DB::table('countries')->get();
        return response()->json([
            'countries' => $countries,
        ]);
    }
}
