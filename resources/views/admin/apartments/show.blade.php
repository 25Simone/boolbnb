@extends('layouts.app')

@php
    use Carbon\Carbon ;
@endphp

@section('content')
<div class="container">
    <h1 class="display-3 text-center">Apartment Number #{{ $apartment->id }}</h1>
        {{-- border: 1px solid #ced4da; --}}
        <div class="show-info">
            <h2 class="info mb-3"> {{ $apartment->title }} </h2>
            <h6>Rooms Number:</h6>
            <h4 class="info mb-3"> {{ $apartment->rooms_number }} </h4>
            <h6>Beds Number:</h6>
            <h4 class="info mb-3"> {{ $apartment->beds_number }} </h4>
            <h6>Baths Number:</h6>
            <h4 class="info mb-3"> {{ $apartment->baths_number }} </h4>
            <h6>Guest:</h6>
            <h4 class="info mb-3"> {{ $apartment->guests }} </h4>

            <h6>Address:</h6>
            <h4 class="info mb-3"> {{ $apartment->address }} </h4>
            <h6>Squaremeters:</h6>
            <h4 class="info mb-3"> {{ $apartment->squaremeters }}mq </h4>


            <h5 class="info mb-3">
                 -{{ $apartment->user->name }}
            </h5>
            <h5 class="info mb-3">Announce Online From:     {{ $apartment->created_at->format('  d/m/Y H:i') }}


            <br> Last Update:  {{ $apartment->updated_at->diffForHumans(Carbon::now()) }} 

            </h5>
            <img src="{{asset('storage/' . $apartment->photo)}}" alt="">
        </div>
</div>
@endsection