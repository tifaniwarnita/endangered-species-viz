<?php

namespace App\Model;

use App\Model\Species;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name'
    ];

    public function species()
    {
        return $this->belongsToMany(Species::class, 'species_countries', 'country_id', 'species_id');
    }
}
