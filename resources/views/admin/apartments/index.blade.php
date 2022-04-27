@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="header-container">
            <h2>MyAPARTMENTS</h2>
            <div class="flex">
                <button class="btn btn-light butt">
                    <a class="btn-create" href="{{route('admin.apartments.create')}}">Create</a>
                </button>
            </div>
            
        </div>

        <div class="card-group">
            @foreach ($apartments as $apartment)
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">{{ $apartment->title }}</h4>
                        <div>
                            <span>Rooms:{{ $apartment->rooms_number }}</span>
                            <span>Beds:{{ $apartment->beds_number }}</span>
                            <span>Bath:{{ $apartment->baths_number }}</span>
                        </div>
                        <div>
                            <span>Guest:{{ $apartment->guests }}</span>
                            <span>MQ:{{ $apartment->squaremeters }}</span>
                        </div>
                        <p>Address:{{ $apartment->address }}</p>
                        <p>Host:{{ $apartment->user->name }}</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-light butt" href="{{route('admin.apartments.show', $apartment->slug)}}">Show</a>
                        <a class="btn btn-light butt" href="{{route('admin.apartments.edit', $apartment->id)}}">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection