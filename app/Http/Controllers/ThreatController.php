<?php

namespace App\Http\Controllers;

use App\Model\Country;
use App\Model\Threat;
use Illuminate\Http\Request;

class ThreatController extends Controller
{
    public function data(Request $request)
    {
        $query = Threat::whereNull('parent_id')->orderBy('order')->withChilds();
        // if ($request->get('country')) {
        //     $country = Country::where('code', $request->get('country'))->first();
        //     $query = $query->with(['species' => function ($query) use ($country) {
        //         $query->where('country_id', $country->id);
        //     }]);
        // }

        $threats = $query->get();
        $result = [];
        $obj = new \stdClass();
        $obj->name = 'root';

        foreach ($threats as $threat) {
            $data = [];
            $data['name'] = $threat->code;
            $firsts = [];
            foreach ($threat->childs as $first) {
                $fdata = [];
                $fdata['name'] = $first->code;
                if (count($first->childs) > 0) {
                    $seconds = [];
                    foreach ($first->childs as $second) {
                        $sdata = [];
                        $sdata['name'] = $second->code;
                        $sdata['size'] = count($second->species);
                        $seconds[] = $sdata;
                    }
                    $fdata['children'] = $seconds;
                } else {
                    $fdata['size'] = count($first->species);
                }

                $firsts[] = $fdata;
            }
            $data['children'] = $firsts;

            $result[] = $data;
        }

        $obj->children = $result;
        return json_encode($obj);
    }

    public function colors()
    {
        $color = [
            '1' => '#4c5454',
            '2' => '#1ea896',
            '3' => '#82b7f7',
            '4' => '#da2c38',
            '5' => '#226f54',
            '6' => '#3b2314',
            '7' => '#c97e60',
            '8' => '#fbb85f',
            '9' => '#b2d869',
            '10' => '#b5343b',
            '11' => '#dd614a',
            '12' => '#c1a172'
        ];

        $threats = Threat::all();
        $result = [];
        foreach ($threats as $threat) {
            $parent = explode(".", $threat->code)[0];
            $result[$threat->code] = $color[$parent];
        }
        return json_encode($result, JSON_FORCE_OBJECT);
    }

    public function labels()
    {
        $threats = Threat::all();
        $result = [];
        foreach ($threats as $threat) {
            $result[$threat->code] = $threat->name;
        }
        return json_encode($result, JSON_FORCE_OBJECT);
    }
}
