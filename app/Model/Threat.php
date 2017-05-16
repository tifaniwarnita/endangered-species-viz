<?php

namespace App\Model;

use App\Model\Extension\TreeTrait;
use App\Model\Country;
use App\Model\Species;
use Illuminate\Database\Eloquent\Model;

class Threat extends Model
{
    use TreeTrait;

    protected $table = 'threats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order',
        'name',
        'parent_id'
    ];

    protected $appends = [
        'code'
    ];

    public function species()
    {
        return $this->belongsToMany(Species::class, 'species_threats', 'threat_id', 'species_id');
    }

    public function countries()
    {
        return $this->hasManyThrough(Country::class, Species::class, 'threat_id', 'species_id', 'country_id');
    }

    public function getCodeAttribute()
    {
        $code = $this->order;
        $firstparent = $this->parent;
        if ($firstparent) {
            $code = $firstparent->order . '.' . $code;
            $secondparent = $firstparent->parent;
            if ($secondparent) {
                $code = $secondparent->order . '.' . $code;
            }
        }
        return $code;
    }
}
