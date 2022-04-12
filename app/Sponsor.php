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
    // Relation  apartments - sponsor
    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
}
