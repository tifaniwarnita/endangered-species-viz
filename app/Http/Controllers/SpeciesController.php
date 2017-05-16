<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Model\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller{
    public function data(Request $request)
    {
        $countries = Country::query()->distinct()->get();
        // $category = Species::selectRaw('count(*) AS cnt, category')->groupBy('category')->get();
        $result = [];
        $obj = new \stdClass();

        foreach ($countries as $country) {
            $data = [];
            $data['Country'] = $country->code;

            $data['Count'] = count($country->species);
            
            $result[] = $data;
        }

        $obj = $result;
        return json_encode($obj);
    }
}

?>