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
    public function user () {
    return $this->belongsTo('App\User');
    }
    //APARTMENT TO ADDITIONAL SERVICE
    public function additional_services(){
        return $this->belongsToMany('App\AdditionalService');
    }
}

// 'title' => 'Casa Ristrutturata In Centro Milano',
// 'rooms_number' => 2.99,
// 'beds_number' => 4,
// 'baths_number' => 2,
// 'guests' => 5,
// 'squaremeters' => 132,
// 'longitude' => '64.325482',
// 'latitude' => '5.423339',
// 'visible' => true,
// 'slug' => 'casa-ristrutturata-in-centro-milano',
// 'photo' => 'https://cdn.dove.it/properties/2069/medium/IMG_4499.jpg',
// 'address' => 'Via XVII Settembre 52B/3',
// 'user_id' => 1, 
