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

        $types = [
            'AVES' => '#ffce8b',
            'MAMMALIA' => '#f7adae', 
            'REPTILIA' => '#c36364', 
            'AMPHIBIA' => '#b8f5e2', 
            'PISCES' => '#b1d5e5', 
            'INVERTEBRATAE' => '#cca498'];
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

        foreach ($types as $key => $type) {
            $data = [];
            $data['key'] = title_case($key);
            $data['color'] = $type;
            $count = 0;

            foreach ($allspecies as $species) {
                if ($species->type === $key) {
                    $count++;
                }
            }

            $data['value'] = $count;
            $result[] = $data;
        }

        return json_encode($result);
    }
}
