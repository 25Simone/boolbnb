<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    // Relation  apartments - additional services
    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
}
