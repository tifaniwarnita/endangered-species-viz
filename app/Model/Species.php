<?php

namespace App\Model;

use App\Model\Country;
use App\Model\Threat;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = 'species';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'common_name',
        'scientific_name',
        'population_trend',
        'category',
        'class'
    ];

    protected $appends = [
        'type'
    ];

    public function threats()
    {
        return $this->belongsToMany(Threat::class, 'species_threats', 'species_id', 'threat_id');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'species_countries', 'species_id', 'country_id');
    }

    public function getTypeAttribute()
    {
        $fishes = [
            'AGNATHA',
            'CHONDRICHTHYES',
            'PLACODERMI',
            'ACANTHODII',
            'OSTEICHTHYES',
            'MYXINI',
            'PTERASPIDOMORPHI',
            'THELODONTI',
            'ANASPIDA',
            'PETROMYZONTIDA',
            'HYPEROARTIA',
            'CONODONTA',
            'CEPHALASPIDOMORPHI',
            'ACTINOPTERYGII',
            'SARCOPTERYGII'
        ];

        if (in_array($this->class, ['AVES', 'MAMMALIA', 'REPTILIA', 'AMPHIBIA'])) {
            return $this->class;
        }
        if (in_array($this->class, $fishes)) {
            return 'PISCES';
        }
        return 'INVERTEBRATAE';
    }
}
