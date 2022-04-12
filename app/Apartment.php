<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    // USER TO APARTMENT 
    public function user () {
    return $this->belongsTo('App\User');
}
}
