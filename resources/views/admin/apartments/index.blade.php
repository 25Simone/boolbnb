@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="header-container">
            <h2>MyAPARTMENTS</h2>
            <div class="d-flex justify-content-end">
                <button class="btn btn-light butt">
                    <a role="button" class="btn-create fw-bold fs-5 mx-3" href="{{route('admin.apartments.create')}}">Create</a>
                </button>
            </div>
            
        </div>

        <div class="row row-cols-5">
            @foreach ($apartments as $apartment)
                <div class="col p-3">
                    <div class="card shadow">
                        <img src="{{asset("storage/" . $apartment->photo)}}" class="card-img-top" alt="...">
                        <div class="card-body apartment-preview">
                            <h4 class="card-title">{{ $apartment->title }}</h4>
                            <div class="d-flex">
                                <div> <span>Rooms: </span>{{ $apartment->rooms_number }}</div>
                                <div> <span>Beds: </span>{{ $apartment->beds_number }}</div>
                                <div> <span>Bath: </span>{{ $apartment->baths_number }}</div>
                            </div>
                            <div class="d-flex">
                                <div> <span>Guest: </span>{{ $apartment->guests }}</div>
                                <div> <span>MQ: </span>{{ $apartment->squaremeters }}</div>
                            </div>
                            <p> <span>Address: </span>{{ $apartment->address }}</p>
                            <p> <span>Host: </span>{{ $apartment->user->name }}</p>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-light butt" href="{{route('admin.apartments.show', $apartment->slug)}}">Show</a>
                            <a class="btn btn-light butt" href="{{route('admin.apartments.edit', $apartment->id)}}">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection