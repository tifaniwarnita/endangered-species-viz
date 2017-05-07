<?php

namespace App\Model;

use App\Model\Extension\TreeTrait;
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

    public function species()
    {
        return $this->belongsToMany(Species::class, 'species_threats', 'threat_id', 'species_id');
    }

    public function scopeAsc($query)
    {
        return $query->orderBy('order', 'ASC')->latest('created_at');
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('order', 'DESC')->oldest('created_at');
    }
}
