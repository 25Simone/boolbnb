<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentsController extends Controller
{
    public function index(Request $request){

        
        // $filter = $request->input('filter');
        $radius = $request->input('radius');
        $filter = 'via Marina,20121,Milano';
    
        
         $coordinate = Http::get('https://api.tomtom.com/search/2/search/.json?key=Cy3GhUqiHtCcdMfQksEJ5XAPmz6EeBsV&query='. $filter . '&countrySet=IT' . '&limit=1');
         $lat = $coordinate["results"][0]["position"]["lat"];
         $lon = $coordinate["results"][0]["position"]["lon"];
        $apartments = Apartment::all()->where('visible',1);
        $apartments->load('user');
        $apartments->load('additional_services');
        $apartments->each(function($apartment){
            $apartment->photo = asset('storage/' . $apartment->photo);
        });
      
        foreach ($apartments as $apartment) {
            $distance = sqrt(pow($lat - $apartment['latitude'],2) + pow($lon - $apartment['longitude'],2)) * 100;
            if($request["radius"]){
                if($distance <= $radius){
                    $apartmentsInRadius[] = $apartment;
                }
            }else{
                if($distance <= 20) {
                    $apartmentsInRadius[] = $apartment;
                }
            }
           
        }

        $filteredResults = $apartmentsInRadius;
        
        //filtro per il numero di camere
        if($request["roomsNumber"]){
            $roomsNumber = $request->input('roomsNumber');
            
            // $apartmentsInRadius = array_filter($apartmentsInRadius,function($apartment){
            //     return $apartment["rooms_number"] >= 2; 
            // });
            $filteredApartments = [];
            foreach($filteredResults as $apartment){
               if($apartment["rooms_number"] >= $roomsNumber){
                    $filteredApartments[] = $apartment;
                }
            };
            $filteredResults = $filteredApartments;
        };

        //filtro per il numero di letti
        if($request["bedsNumber"]){
            $bedsNumber = $request->input('bedsNumber');
            
            $filteredApartments = [];
            foreach($filteredResults as $apartment){
               if($apartment["beds_number"] >= $bedsNumber){
                    $filteredApartments[] = $apartment;
                }
            };
            $filteredResults = $filteredApartments;
        };

        //filtro per i servizi aggiuntivi
        if($request["checkedService"]){
            $checkedServices = $request->input('checkedService');
            
            $filteredApartments = [];
            
            foreach($filteredResults as $apartment){
                $commonValues = [];
                $servicesIdList = [];
                $apartmentServices =  $apartment->additional_services;
                foreach($apartmentServices as $apartmentService) {
                    $servicesIdList[] = $apartmentService->id;
                }
                // foreach ($servicesIdList as $serviceId) {
                //     if (in_array($serviceId, $checkedServices)) {
                //         $commonValues[] = $serviceId;
                //     }
                // }
                $commonValues = array_intersect($checkedServices,$servicesIdList);
                if (count($commonValues) === count($checkedServices) ){
                    $filteredApartments[] = $apartment;
                }
            };
            $filteredResults = $filteredApartments;
        };


        return response()->json(
         $filteredResults,
        );

    }
    public function show($slug){
        $apartment = Apartment::where('slug',$slug)->with('additional_services')->with('user')->first();
        if(!$apartment){
            abort(404);
        }
        
            $apartment->photo = asset('storage/' . $apartment->photo);
        

        return response()->json($apartment);
    }
}


