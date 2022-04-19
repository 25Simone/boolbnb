@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-3 text-center">Edit Your Apartment</h1>
    <form action="{{ route('admin.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")

        {{-- TITLE SECTION  --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Title</label>
  
            <input placeholder="Insert your title apartment" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $apartment->title) }}">
              @error("title")
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

        {{-- ROOMS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Rooms</label>
  
            <input placeholder="Insert the number of your rooms" type="number" value="{{ old('rooms_number', $apartment->rooms_number) }}" name="rooms_number" class="form-control  @error('rooms_number') is-invalid @enderror" min='0'>
              @error("rooms_number")
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>

        {{-- BEDS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Beds</label>
  
            <input placeholder="Insert the number of your beds" type="number" value="{{ old('beds_number', $apartment->beds_number) }}" name="beds_number" class="form-control  @error('beds_number') is-invalid @enderror" min='0'>
              @error('beds_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>

        {{-- BATHS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Baths</label>
  
            <input placeholder="Insert the number of your baths" type="number" value="{{ old('baths_number', $apartment->baths_number) }}" name="baths_number" class="form-control  @error('baths_number') is-invalid @enderror" min='0'>
              @error('baths_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>
        
        {{-- GUESTS SECTION  --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Guests</label>
  
            <input placeholder="Insert the number that the apartment can accommodate" type="number" value="{{ old('guests', $apartment->guests) }}" name="guests" class="form-control  @error('guests') is-invalid @enderror" >
              @error('guests')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>

        {{-- SQUAREMETERES SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Squaremeters</label>
  
            <input placeholder="Insert the number of squaremeters of your apartment" type="text" value="{{ old('squaremeters', $apartment->squaremeters) }}" name="squaremeters" class="form-control  @error('squaremeters') is-invalid @enderror">
              @error('squaremeters')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>

        {{-- ADRESS SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Address</label>
  
            <input placeholder="Via Roma 1, 20099 " type="text" value="{{ old('address', $apartment->address) }}" name="address" class="form-control  @error('address') is-invalid @enderror">
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>

        {{-- IMAGE UPLOAD SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Add photo</label>
  
            <input  type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
              @error('photo')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="image-custom">
                    <img src="{{asset('storage/' . $apartment->photo)}}" alt="">
              </div>
          </div>

        {{-- ADDITIONAL SERVICES SECTION --}}
        <div class="mb-3">
            <label class="form-label">Additional services</label>
            <br>
            @foreach ($services as $service )
              <div class="form-check form-check-inline">
                <label for="service_{{$service->id}}">{{$service->name}}</label>
                <input
                {{ ($apartment->additional_services->contains($service) ? 'checked' : '') }}
                id="service_{{$service->id}}" type="checkbox" class="form-check-input" name="services[]" value="{{$service->id}}">
              </div>
            @endforeach
        </div>

        {{-- SUBMIT BUTTON TO STORE --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection