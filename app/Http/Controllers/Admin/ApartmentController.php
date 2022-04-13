<?php

namespace App\Http\Controllers\Admin;

use App\AdditionalService;
use App\Apartment;
use App\Http\Controllers\Controller;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    use SlugGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $apartments = Apartment::all();
        $apartments = Apartment::where("user_id", Auth::user()->id)
        ->get();

        return view('admin.apartments.index', compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //import additional services 
        $services = AdditionalService::all();
        return view('admin.apartments.create',compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "title"=>"string|required|min:10",
                "rooms_number"=>"numeric|required",
                "beds_number"=>"numeric|required",
                "baths_number"=>"numeric|required",
                "guests"=>"numeric|required",
                "squaremeters"=>"nullable|numeric|min:2|max:7",
                "address"=>"required|min:5",
                "photo"=>"required|max:1000",
            ]
            );
        //instance a new line
        $newApartment = new Apartment();

        //fill line
        $newApartment->fill($data);
        $newApartment->slug = $this->generateUniqueSlug($newApartment->title);  //generazione slug
        $newApartment->user_id = Auth::user()->id;
        if(key_exists("photo",$data)){
            $newApartment->photo = Storage::put("apartmentImages",$data["photo"]);
        }

        $newApartment->save();
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
