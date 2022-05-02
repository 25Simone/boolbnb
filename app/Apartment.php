<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'rooms_number',
        'beds_number',
        'baths_number',
        'guests',
        'squaremeters',
        'longitude',
        'latitude',
        'visible',
        'slug',
        'photo',
        'address',
        'user_id',
    ];

    // USER TO APARTMENT 
    public function user() {
    return $this->belongsTo('App\User');
    }
    //CONTACT TO APARTMENT
    public function contacts() {
        return $this->belongsToMany('App\Contact');
    }
    //APARTMENT TO ADDITIONAL SERVICE
    public function additional_services(){
        return $this->belongsToMany('App\AdditionalService');
    }
}

