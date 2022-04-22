<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
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
    public function index() {
        // Get the apatments where user_id is equal to the id of the logged in user
        $apartments = Apartment::where("user_id", Auth::user()->id)->get();

        return view('admin.apartments.index', compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Import additional services 
        $services = AdditionalService::all();
        return view('admin.apartments.create',compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validation rules
        $data = $request->validate(
            [
                "title"=>"required|string|min:10",
                "rooms_number"=>"numeric|required",
                "beds_number"=>"numeric|required",
                "baths_number"=>"numeric|required",
                "guests"=>"numeric|required",
                "squaremeters"=>"nullable|numeric|min:2|",
                "address"=>"required|min:5",
                "latitude" => "numeric",
                "longitude" => "numeric",
                "photo"=>"required|max:1000",
                "services"=>"required|array|min:1",
                "visible" => "nullable|boolean",
            ]
            );
            // dd($data);



        // Instance a new line
        $newApartment = new Apartment();
            //check if apartemnt is visible
            if(!key_exists("visible",$data)){
                $newApartment->visible = 0;
            }

        $newApartment->fill($data);

    
        // Define the slug value
        $newApartment->slug = $this->generateUniqueSlug($newApartment->title);
        // Define the user_id value as the id of the logged in user
        $newApartment->user_id = Auth::user()->id;
        // If photo key exists in data, equals it to newApartment->photo
        if(key_exists("photo",$data)){
            $newApartment->photo = Storage::put("apartmentImages",$data["photo"]);
        }

        // Save the line
  
        $newApartment->save();

        // Adds the relations with the services taken from the form
        if(key_exists('services',$data)){
            $newApartment->additional_services()->attach($data['services']);
        }
        // dd($newApartment);

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $apartment = Apartment::where("slug", $slug)->first();

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = AdditionalService::all();

        return view('admin.apartments.edit', compact('apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment) {
        // Save and validate the form's data
        $data = $request->validate(
        // Validation rules
        [
            "title"=>"required|string|min:10",
            "rooms_number"=>"numeric|required",
            "beds_number"=>"numeric|required",
            "baths_number"=>"numeric|required",
            "guests"=>"numeric|required",
            "squaremeters"=>"nullable|numeric|min:2|",
            "address"=>"required|min:5",
            "latitude" => "numeric",
            "longitude" => "numeric",
            "photo"=>"nullable|image|max:1000",
            "services"=>"required|array|min:1",
            "visible" => "nullable|boolean"
        ]);
        // dd($data);

        // Generate new slug if the title change
        if ($data["title"] !== $apartment->title) {
            $data["slug"] = $this->generateUniqueSlug($data["title"]);
        }

         //check if apartemnt is visible
         if(!key_exists("visible",$data)){
            $apartment->visible = 0;
        }

        //Update apartment
        $apartment->update($data);

        // If photo exist in DB delete image from db and from storage and replace new image in the request
        if (key_exists("photo", $data)) {
    
            Storage::delete($apartment->photo);          
            $apartment->photo = Storage::put("apartmentImages", $data["photo"]);
            $apartment->save();
        }

        if (key_exists("services", $data)) {
            // Sync the changes
            $apartment->additional_services()->sync($data["services"]);
        }

        return redirect()->route("admin.apartments.show", $apartment->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment) {
        // Additional services detach
        $apartment->additional_services()->detach();

        // Delete apartment's photo from the storage
        Storage::delete($apartment->photo);

        // Delete apartment
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
