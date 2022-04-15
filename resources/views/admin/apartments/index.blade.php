@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>APARTMENTS</h1>
        <h4 class="nav-item">
            <a class="nav-link" href="{{route('admin.apartments.create')}}">Create</a>
        </h4>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th class="col">Title</th>
                    <th class="col">Rooms number</th>
                    <th class="col">Beds Number</th>
                    <th class="col">Baths Number</th>
                    <th class="col">Guest Number</th>
                    <th class="col">MQ</th>
                    <th class="col">Adress</th>
                    <th class="col">Apartment Owner</th>
                    <th class="col">Show</th>
                    <th class="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->rooms_number }}</td>
                        <td>{{ $apartment->beds_number }}</td>
                        <td>{{ $apartment->baths_number }}</td>
                        <td>{{ $apartment->guests }}</td>
                        <td>{{ $apartment->squaremeters }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->user->name }}</td>
                        <td><a class="btn btn-primary" href="{{route('admin.apartments.show', $apartment->slug)}}">Show</a></td>
                        <td><a class="btn btn-primary" href="{{route('admin.apartments.edit', $apartment->id)}}">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection