@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-3 text-center">Post Your Apartment!</h1>
    <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
        @csrf


        {{-- TITLE SECTION  --}}
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Apartment Title</label>

          <input type="text" value="{{ old('title') }}" name="title" class="form-control" >
            @error('title')
                {{ $message }}
            @enderror

            <div id="emailHelp" class="form-text">Insert your title apartment!</div>

        </div>
        {{-- ROOMS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Rooms</label>
  
            <input type="number" value="{{ old('rooms_number') }}" name="rooms_number" class="form-control" >
              @error('rooms_number')
                  {{ $message }}
              @enderror
  
            <div id="emailHelp" class="form-text">Insert the number of your rooms!</div>
  
        </div>

        {{-- BEDS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Beds</label>
  
            <input type="number" value="{{ old('beds_number') }}" name="beds_number" class="form-control" >
              @error('beds_number')
                  {{ $message }}
              @enderror
  
            <div id="emailHelp" class="form-text">Insert the number of your beds!</div>
  
        </div>

        {{-- BATHS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Baths</label>
  
            <input type="number" value="{{ old('baths_number') }}" name="baths_number" class="form-control" >
              @error('baths_number')
                  {{ $message }}
              @enderror
  
            <div id="emailHelp" class="form-text">Insert the number of your baths!</div>
  
        </div>

        {{-- GUESTS SECTION  --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Guests</label>
  
            <input type="number" value="{{ old('guests') }}" name="guests" class="form-control" >
              @error('guests')
                  {{ $message }}
              @enderror
  
            <div id="emailHelp" class="form-text">Insert the number that the apartment can accommodate!</div>
  
        </div>

        {{-- SQUAREMETERES SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Squaremeters</label>
  
            <input type="number" value="{{ old('squaremeters') }}" name="squaremeters" class="form-control" >
              @error('squaremeters')
                  {{ $message }}
              @enderror
  
            <div id="emailHelp" class="form-text">Insert the number of squaremeters of your apartment!</div>
  
        </div>

        {{-- ADRESS SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Address</label>
  
            <input type="text" value="{{ old('address') }}" name="address" class="form-control" >
              @error('address')
                  {{ $message }}
              @enderror
  
              <div id="emailHelp" class="form-text">Insert your apartment address!</div>
  
          </div>

        {{-- LONGITUDE & LATITUDE SECTION --}}
        <div class="mb-3 d-flex">
            <span class="w-50">
                <label for="exampleInputEmail1" class="form-label w-100 text-center">Apartment Longitude</label>
    
                <input type="text" value="{{ old('longitude') }}" name="longitude" class="form-control" >
                    @error('longitude')
                        {{ $message }}
                    @enderror
    
                <span id="emailHelp" class="form-text">Insert the longitude cords</span>
            </span>

           <span class="w-50">
                <label for="exampleInputEmail1" class="form-label w-100 text-center">Apartment Longitude</label>
        
                <input type="text" value="{{ old('latitude') }}" name="latitude" class="form-control" >
                    @error('latitude')
                        {{ $message }}
                    @enderror
        
                    <span id="emailHelp" class="form-text">Insert the latitude cords</span>
           </span>

        </div>


        {{-- DA FINIRE :  --}}
        {{-- VISIBLE SECTION --}}

        {{-- IMAGE UPLOAD SECTION --}}
   
        {{-- SUBMIT BUTTON TO STORE --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection