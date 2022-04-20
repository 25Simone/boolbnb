<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
    public function index(Request $request){
        
        $filter = $request->input('filter');
        $apartments = Apartment::where("address","LIKE","%$filter%")->paginate(8);
        $apartments->load('user');
        $apartments->load('additional_services');
        $apartments->each(function($apartment){
            $apartment->photo = asset('storage/' . $apartment->photo);
        });
        return response()->json($apartments);

    }
}
