@extends('layouts.app')

@section('content')
    <div class="container-fluid my-apartments-section">
        <div class="header-container mt-5 p-2">
            <h2>My Apartments</h2>
            <button class="btn btn-light butt create-btn">
                <a role="button" class="btn-create fw-bold fs-5 mx-3" href="{{route('admin.apartments.create')}}">Create</a>
            </button>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4">
            @foreach ($apartments as $apartment)
                <div class="col p-4">
                    <div class="card shadow">
                        @if (!$apartment->visible)<span class="badge bg-danger">Not visible</span> @endif
                        <div class="img-container">
                            <img src="{{asset("storage/" . $apartment->photo)}}" class="card-img-top" alt="...">
                        </div>
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
                            <a class="btn btn-light butt fw-bold" href="{{route('admin.apartments.show', $apartment->slug)}}">Show</a>
                            <a class="btn btn-light butt fw-bold" href="{{route('admin.apartments.edit', $apartment->id)}}">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection