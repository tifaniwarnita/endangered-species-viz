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
            $data['name'] = $threat->name;
            $firsts = [];
            foreach ($threat->childs as $first) {
                $fdata = [];
                $fdata['name'] = $first->name;
                if (count($first->childs) > 0) {
                    $seconds = [];
                    foreach ($first->childs as $second) {
                        $sdata = [];
                        $sdata['name'] = $second->name;
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
}
