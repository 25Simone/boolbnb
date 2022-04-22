<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentsController extends Controller
{
    public function index(Request $request){
        
        $filter = $request->input('filter');
        
        
         $coordinate = Http::get('https://api.tomtom.com/search/2/search/.json?key=Cy3GhUqiHtCcdMfQksEJ5XAPmz6EeBsV&query='. $filter . '&countrySet=IT' . '&limit=1');
         $lat = $coordinate["results"][0]["position"]["lat"];
         $lon = $coordinate["results"][0]["position"]["lon"];
        //  dump($lat,$lon);
        $apartments = Apartment::all()->where('visible',1);
        $apartments->load('user');
        $apartments->load('additional_services');
        $apartments->each(function($apartment){
            $apartment->photo = asset('storage/' . $apartment->photo);
        });
        foreach ($apartments as $apartment) {
            $distance = sqrt(pow($lat - $apartment['latitude'],2) + pow($lon - $apartment['longitude'],2)) * 100;
            if ($distance <= 20) {
                $apartmentsInRadius[] = $apartment;
            }
        }
        // dump($apartmentsInRadius);
       
        return response()->json($apartmentsInRadius);

    }
}


