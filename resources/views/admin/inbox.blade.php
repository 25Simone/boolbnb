@extends('layouts.app')

@section('content')


    @foreach ($contacts as $contact)
        {{$contact->message}}
    @endforeach




@endsection