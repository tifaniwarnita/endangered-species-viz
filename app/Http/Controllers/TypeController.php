<?php

namespace App\Http\Controllers;

use App\Model\Country;
use App\Model\Species;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function data(Request $request)
    {
        $allspecies = Species::all();
        $types = ['AVES', 'MAMMALIA', 'REPTILIA', 'AMPHIBIA', 'PISCES', 'INVERTEBRATAE'];
        $result = [];

        $cat = $request->get('category');
        $country = Country::where('code', $request->get('country'))->first();

        if ($cat) {
            $allspecies = $allspecies->where('category', $cat);
        }

        if ($country) {
            $s = Species::whereHas('countries', function ($q) use ($country) {
                $q->where('id', $country->id);
            })->get()->pluck('id')->toArray();

            $allsp = [];
            foreach ($allspecies as $sp) {
                if (in_array($sp->id, $s)) {
                    $allsp[] = $sp;
                }
            }
            $allspecies = $allsp;
        }

        foreach ($types as $type) {
            $data = [];
            $data['key'] = title_case($type);
            $count = 0;

            foreach ($allspecies as $species) {
                if ($species->type === $type) {
                    $count++;
                }
            }

            $data['value'] = $count;
            $result[] = $data;
        }

        return json_encode($result);
    }
}
