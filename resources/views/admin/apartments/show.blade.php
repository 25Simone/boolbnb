@extends('layouts.app')

@php
    use Carbon\Carbon ;
@endphp

@section('content')
<div class="container customscss">
    <div class="row b-red-und">
        <div class="col">
            <h1 class="mt-50 display-5">
                {{ $apartment->title }} 
            </h1>
            <h6> 
                Host: <span class="fw-bold text-decoration-underline">{{ $apartment->user->name }}</span>
                <span class="separator-c"><i class="fas fa-slash"></i></span>
                Total Apartments: <span class="fw-bold text-decoration-underline">{{ $apartment->user->apartment->count() }}</span>
                <span class="separator-c"><i class="fas fa-slash"></i></span>
                Address House: <span class="fw-bold text-decoration-underline">{{ $apartment->address }}</span>
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img class="img-c-show" src="{{asset("storage/" . $apartment->photo)}}" alt="post image">
        </div>
    </div>
    <div class="row b-red-und">
        <div class="col-md-6">
            <h2 class="mt-50 display-6">Apartment Info:</h2>
            <ul class="list-info custom-right">
                <li class="h5">
                    <i class="fa-solid fa-people-roof"></i>
                    Apartment Rooms: <span class="fw-bold text-decoration-underline">{{ $apartment->rooms_number }}</span>
                </li>
                <li class="h5">
                    <i class="fa-solid fa-bed"></i>
                    Apartment Beds: <span class="fw-bold text-decoration-underline">{{ $apartment->beds_number }}</span>
                </li>
                <li class="h5">
                    <i class="fa-solid fa-person-booth custom-m"></i>
                    Apartment Baths: <span class="fw-bold text-decoration-underline">{{ $apartment->baths_number }}</span>
                </li>
                <li class="h5">
                    <i class="fa-solid fa-people-roof"></i>
                    Apartment Guests: <span class="fw-bold text-decoration-underline">{{ $apartment->guests }}</span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <h2 class="mt-50 display-6">Additional Service:</h2>
            <ul class="list-info">
                @foreach ($apartment->additional_services as $service)
                    <li class="h5">{{ $service->name }} <i class="fa-solid fa-check"></i></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row me-50">
        <div class="col-12">
            <h2 class="display-6 mt-50">More Information & Customize</h2>
            <div>
                <strong>Data di creazione: </strong>{{ $apartment->created_at->format("d-m-Y") }}
            </div>
            <div>
                <strong>Ultima modifica: </strong>{{ $apartment->updated_at }} ({{ $apartment->updated_at->diffForHumans(date(0)) }})
            </div>
            <div>
                <strong>Squaremeters: </strong>{{ $apartment->squaremeters }}
            </div>
            <div>
                <strong>Apartment Visible: </strong>
                    @if ($apartment->visible == 1)
                        <span class="text-success">True</span>
                    @else
                        <span class="text-danger">False</span>
                    @endif
            </div>
            <div class="d-flex justify-content-center p-3">
                <a class="btn btn-outline-secondary mx-2" href="{{ route('admin.apartments.edit', $apartment->id) }}">Modifica</a>   
            
                @include('partials.deleteButton', [
                    "route"=>"admin.apartments.destroy",
                    "id"=>$apartment->id,
                ])
            </div>
        </div>
    </div>
</div>




@endsection








{{-- <img class="img-fluid rounded" src="{{asset("storage/" . $apartment->photo)}}" alt="post image"> --}}

{{-- <div class="d-flex justify-content-center p-3">
    <a class="btn btn-outline-secondary mx-2" href="{{ route('admin.apartments.edit', $apartment->id) }}">Modifica</a>   

    @include('partials.deleteButton', [
        "route"=>"admin.apartments.destroy",
        "id"=>$apartment->id,
    ])
</div> --}}

{{-- <div>
    <strong>Servizi: </strong>
    @forelse ($apartment->additional_services as $service)
        <span> {{$service->name}}, </span>
    @empty
        <span>Nessun Servizio Inserito</span>              
    @endforelse
</div> --}}

{{-- <div>
    <strong>Data di creazione: </strong>{{ $apartment->created_at->format("d-m-Y") }}
</div>
<div>
    <strong>Ultima modifica: </strong>{{ $apartment->updated_at }} ({{ $apartment->updated_at->diffForHumans(date(0)) }})
</div> --}}