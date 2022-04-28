@extends('layouts.app')

@section('content')
@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<div>
  <div class="row row-cols-2 m-0 align-items-stretch" id="create-form-wrapper">
    <div class="col create-section-left">
      <h1 class="display-3 text-center">Edit Your Apartment!</h1>
    </div>
    {{-- FORM --}}
    <div class="col form">
        <form action="{{ route('admin.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method("put")

          {{-- TITLE SECTION  --}}

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Title *</label>

            <input  placeholder="Insert your title apartment" type="text" name="title" class="bord-red form-control @error('title') is-invalid @enderror" value="{{ old('title', $apartment->title) }}" required>
              @error("title")
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

          <div class="row row-cols-2">
            {{-- ROOMS NUMBER SECTION --}}
            <div class="mb-3 col">
                <label for="exampleInputEmail1" class="form-label">Apartment Rooms *</label>
      
                <input placeholder="Insert the number of your rooms" type="number" value="{{ old('rooms_number', $apartment->rooms_number) }}" name="rooms_number" class="form-control bord-red  @error('rooms_number') is-invalid @enderror" required min='0'>
                  @error("rooms_number")
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
  
            {{-- BEDS NUMBER SECTION --}}
            <div class="mb-3 col">
                <label for="exampleInputEmail1" class="form-label">Apartment Beds *</label>
      
                <input placeholder="Insert the number of your beds" type="number" value="{{ old('beds_number', $apartment->beds_number) }}" name="beds_number" class="form-control bord-red  @error('beds_number') is-invalid @enderror" required min='0'>
                  @error('beds_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
          </div>

          <div class="row row-cols-2">
            {{-- BATHS NUMBER SECTION --}}
            <div class="mb-3 col">
                <label for="exampleInputEmail1" class="form-label">Apartment Baths *</label>
      
                <input placeholder="Insert the number of your baths" type="number" value="{{ old('baths_number', $apartment->baths_number) }}" name="baths_number" class="form-control bord-red  @error('baths_number') is-invalid @enderror" required min='0'>
                  @error('baths_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
  
            {{-- GUESTS SECTION  --}}
            <div class="mb-3 col">
                <label for="exampleInputEmail1" class="form-label">Apartment Guests *</label>
      
                <input placeholder="Insert the number that the apartment can accommodate" type="number" value="{{ old('guests', $apartment->guests) }}" name="guests" class="form-control bord-red  @error('guests') is-invalid @enderror" required  min='0'>
                  @error('guests')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
          </div>

          {{-- SQUAREMETERES SECTION --}}
          <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Apartment Squaremeters</label>
    
              <input placeholder="Insert the number of squaremeters of your apartment" type="text" value="{{ old('squaremeters', $apartment->squaremeters) }}" name="squaremeters" class="form-control bord-red  @error('squaremeters') is-invalid @enderror">
                @error('squaremeters')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
          </div>

          {{-- ADRESS SECTION --}}
          <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Apartment Address *</label>
    
              <input autocomplete=off id="address_input" placeholder="Via Roma 1, 20099 " type="text" value="{{ old('address', $apartment->address) }}" name="address" class="form-control bord-red  @error('address') is-invalid @enderror" required>
                <div id="suggestedAddresses"></div>
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
          </div>
          
          {{-- IMAGE UPLOAD SECTION --}}
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Add photo *</label>

            <input  type="file" name="photo" class="form-control bord-red @error('photo') is-invalid @enderror" required>
              @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="imageedit">
                <img src="{{asset('storage/' . $apartment->photo)}}" alt="">
              </div>
              
          </div>

          {{-- ADDITIONAL SERVICES SECTION --}}
          <div class="mb-3">
              <label class="form-label">Additional services *</label>
              <br>
              @foreach ($services as $service )
                <div class="form-check form-check-inline">
                  <label for="service_{{$service->id}}">{{$service->name}}</label>
                  <input {{ ($apartment->additional_services->contains($service) ? 'checked' : '') }} id="service_{{$service->id}}" type="checkbox" class="form-check-input" name="services[]" value="{{$service->id}}">
                </div>
              @endforeach
          </div>

            {{-- VISIBLE SECTION --}}
          <div class="mb-3">
            <label for="visibleCheckBox">Visible</label>
            <input type="checkbox" class="form-check-input" name="visible" value=1 {{$apartment->visible ? 'checked' : ''}}>
          </div>

          {{-- LATITUDE AND LONGITUDE SECTION --}}
          <div class="d-none">
            <input type="text" id="latitudeInput" name="latitude" value="{{old('latitude')}}">
            <input type="text" id="longitudeInput" name="longitude" value="{{old('longitude')}}">
          </div>
          
          {{-- SUBMIT BUTTON TO STORE --}}
          <button type="submit" class="btn btn-primary bord-red">Update!</button>
        </form>
    </div>
  </div>
    
</div>


<script>
  const address = document.getElementById('address_input');
  const suggestedAddresses = document.getElementById('suggestedAddresses');
  const latitude = document.getElementById('latitudeInput');
  const longitude = document.getElementById('longitudeInput');
  // Input listner
  address.addEventListener('keypress',function(e){
    // Reset
    suggestedAddresses.innerHTML = '';
    // Define the input value variable
    const searchedAddress = e.target.value.toLowerCase();

    if(searchedAddress !== ''){
      delete axios.defaults.headers.common['X-Requested-With']; 
      // Axios call to TomTom
      axios.get('https://api.tomtom.com/search/2/search/.json?key=Cy3GhUqiHtCcdMfQksEJ5XAPmz6EeBsV&query=' + searchedAddress + '&countrySet=IT')
      .then(res=>{
        const results = res.data.results.filter(element => {
          return element.address.countrySecondarySubdivision === 'Milano';
        });
        results.forEach((element,i) => {
          // Create in DOM the suggestedAddress element
          const suggestedAddress = document.createElement('div');
          suggestedAddress.innerHTML += `${element.address.freeformAddress}`;
          // Append the suggestedAddress element in suggestedAddresses container
          suggestedAddresses.append(suggestedAddress);
          // Add click listener on each suggestedAddress element
          suggestedAddress.addEventListener('click',function(){
            address.value = this.textContent;
            latitude.value = element.position.lat;
            longitude.value = element.position.lon;
            
            // Reset
            suggestedAddresses.innerHTML = '';
          })
        });
      })
    }
  })
</script>
@endsection