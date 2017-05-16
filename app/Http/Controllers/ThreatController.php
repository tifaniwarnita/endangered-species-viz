<?php

namespace App\Http\Controllers;

use App\Model\Country;
use App\Model\Species;
use App\Model\Threat;
use Illuminate\Http\Request;

class ThreatController extends Controller
{
    public function data(Request $request)
    {
        $query = Threat::whereNull('parent_id')->orderBy('order')->withChilds();
        $threats = $query->get();
        $result = [];
        $obj = new \stdClass();
        $obj->name = 'root';

        $cat = $request->get('category');
        $country = Country::where('code', $request->get('country'))->first();
        if ($country) {
            $s = Species::whereHas('countries', function ($q) use ($country) {
                $q->where('id', $country->id);
            })->get()->pluck('id')->toArray();
        }
        // return $s;

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
                        $species = $second->species;
                        if ($cat) {
                            $species = $species->where('category', $cat);
                        }
                        if ($country) {
                            $allsp = [];
                            foreach ($species as $sp) {
                                if (in_array($sp->id, $s)) {
                                    $allsp[] = $sp;
                                }
                            }
                            $species = $allsp;
                        }
                        $sdata['size'] = count($species);
                        $seconds[] = $sdata;
                    }
                    $fdata['children'] = $seconds;
                } else {
                    $species = $first->species;
                    if ($cat) {
                        $species  = $species->where('category', $cat);
                    }
                    if ($country) {
                        $allsp = [];
                        foreach ($species as $sp) {
                            if (in_array($sp->id, $s)) {
                                $allsp[] = $sp;
                            }
                        }
                        $species = $allsp;
                    }
                    $fdata['size'] = count($species);
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
            '1' => '#ED9798',
            '2' => '#F2B77E',
            '3' => '#EBE166',
            '4' => '#B7E2B2',
            '5' => '#81C0AB',
            '6' => '#D3D1A8',
            '7' => '#B9DCEE',
            '8' => '#D67169',
            '9' => '#D28561',
            '10' => '#DEC862',
            '11' => '#8AC28C',
            '12' => '#4B8882'
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
