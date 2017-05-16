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

        $category = Species::selectRaw('count(*) AS cnt, population_trend')->groupBy('population_trend')->get();
        
        $result = [];
        $obj = new \stdClass();

        foreach ($countries as $country) {
            $data = [];
            $data['Country'] = $country->code;

            // Add category info
            foreach($category as $cat) {
                $data[ucfirst($cat->population_trend)] = 0;
            }

            // Count species 
            foreach($country->species as $species) {
                $data[ucfirst($species->population_trend)] += 1;
            }
            
            $result[] = $data;
        }

        $obj = $result;
        return json_encode($obj);
    }

    public function countries()
    {
        $countries = Country::all();
        $result = [];
        foreach ($countries as $country) {
            $result[$country->code] = $country->name;
        }
        return json_encode($result, JSON_FORCE_OBJECT);
    }


}
