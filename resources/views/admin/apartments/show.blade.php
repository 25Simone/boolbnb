@extends('layouts.app')

@php
    use Carbon\Carbon ;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div>
                        Dettagli appartamento
                    </div>
                </div>
                
      
                <div class="card-body">
                    <div class="post-image">
                        <img class="img-fluid rounded" src="{{asset("storage/" . $apartment->photo)}}" alt="post image">
                    </div>
                    <strong class="fs-4">{{ $apartment->title }}</strong>
                    <div class="row row-cols-2">
                        <div class="col d-flex flex-column">
                            <div>
                                <strong>Rooms: </strong>{{ $apartment->rooms_number }}
                            </div>
                            <div>
                                <strong>Beds: </strong>{{ $apartment->beds_number }}
                            </div>
                            <div>
                                <strong>Baths: </strong>{{ $apartment->baths_number }}
                            </div>
                            <div>
                                <strong>Guests: </strong>{{ $apartment->guests }}
                            </div>
                            <div>
                                <strong>Address: </strong>{{ $apartment->address }}
                            </div>
                            <div>
                                <strong>Mq: </strong>{{ $apartment->squaremeters }}
                            </div>
                        </div>

                        <div class="col d-flex flex-column">
                            <div>
                                <strong>Host: </strong>{{ $apartment->user->name }}
                            </div>
                            <div>
                                <strong>Email: </strong>{{ $apartment->user->email }}
                            </div>
                            <div>
                                <strong>Data di creazione: </strong>{{ $apartment->created_at->format("d-m-Y") }}
                            </div>
                            <div>
                                <strong>Ultima modifica: </strong>{{ $apartment->updated_at }} ({{ $apartment->updated_at->diffForHumans(date(0)) }})
                            </div>
                            <div>
                                <strong>Servizi: </strong>
                                @forelse ($apartment->additional_services as $service)
                                    <span> {{$service->name}}, </span>
                                @empty
                                    <span>Nessun Servizio Inserito</span>              
                                @endforelse
                            </div>
                        </div>
                    </div>
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
</div>
@endsection