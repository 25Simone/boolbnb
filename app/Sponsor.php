<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration'
    ];
    // Relation  apartments - sponsots
    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
}
