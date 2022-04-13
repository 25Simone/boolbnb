@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-3 text-center">Post Your Apartment!</h1>
    <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
        @csrf


        {{-- TITLE SECTION  --}}
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Apartment Title</label>

          <input placeholder="Insert your title apartment" type="text" value="{{ old('title') }}" name="title" class="form-control @error('title') is-invalid @enderror" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            

        </div>
        {{-- ROOMS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Rooms</label>
  
            <input placeholder="Insert the number of your rooms" type="number" value="{{ old('rooms_number') }}" name="rooms_number" class="form-control  @error('rooms_number') is-invalid @enderror" required>
              @error('rooms_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

        </div>

        {{-- BEDS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Beds</label>
  
            <input placeholder="Insert the number of your beds" type="number" value="{{ old('beds_number') }}" name="beds_number" class="form-control  @error('beds_number') is-invalid @enderror" required>
              @error('beds_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

        </div>

        {{-- BATHS NUMBER SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Baths</label>
  
            <input placeholder="Insert the number of your baths" type="number" value="{{ old('baths_number') }}" name="baths_number" class="form-control  @error('baths_number') is-invalid @enderror" required>
              @error('baths_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
  
        </div>

        {{-- GUESTS SECTION  --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Guests</label>
  
            <input placeholder="Insert the number that the apartment can accommodate" type="number" value="{{ old('guests') }}" name="guests" class="form-control  @error('guests') is-invalid @enderror" required>
              @error('guests')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
  
        </div>

        {{-- SQUAREMETERES SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Squaremeters</label>
  
            <input placeholder="Insert the number of squaremeters of your apartment" type="number" value="{{ old('squaremeters') }}" name="squaremeters" class="form-control">
              @error('squaremeters')
                  {{ $message }}
              @enderror
  
        </div>

        {{-- ADRESS SECTION --}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Address</label>
  
            <input placeholder="Insert your apartment address" type="text" value="{{ old('address') }}" name="address" class="form-control  @error('address') is-invalid @enderror" required>
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

          </div>

        {{-- DA FINIRE :  --}}
        
        {{-- IMAGE UPLOAD SECTION --}}
   
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Add photo</label>

          <input  type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" required>
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            

        </div>
        {{-- SUBMIT BUTTON TO STORE --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection