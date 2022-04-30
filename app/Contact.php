<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        "name",
        "email",
        "lastname",
        "message",
        "apartment_id"
    ];
    //APARTMENT TO CONTACT
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}
