<?php

namespace App\Http\Controllers;

use App\Model\Country;
use App\Model\Species;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    public function data(Request $request)
    {
        $countries = Country::with('species')->get();
        $category = Species::selectRaw('count(*) AS cnt, category')->groupBy('category')->get();
        $result = [];
        $obj = new \stdClass();

        foreach ($countries as $country) {
            $data = [];
            $data['Country'] = $country->code;

            // Add category info
            foreach($category as $cat) {
                $data[$cat->category] = 0;
            }

            // Count species 
            foreach($country->species as $species) {
                $data[$species->category] += 1;
            }
            
            $result[] = $data;
        }

        $obj = $result;
        return json_encode($obj);
    }
}
