<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return view('city-detail', ['city' => $city]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $cities = City::select('id','name')->where('name', 'LIKE', "{$query}%")->get();
        return response()->json($cities);
    }
}
