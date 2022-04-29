@extends('layouts.app')

@section('content')
    <div class="container pt-4 inbox-section">
        <h1 class="text-center p-4 fw-bold">Your <span>Inbox</span></h1>
        <div class="card p-3">
            <div class="row">
                @foreach ($contacts as $contact)
                    <div class="py-2 px-3 border-bottom message dropdown">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4> <span>Message from: </span> {{ $contact->name }} {{ $contact->lastname }}</h4>
                                <div>For: {{ $contact->apartment->title }}</div>
                            </div>
                            <div>{{ $contact->email }}</div>
                        </div>
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                            Details
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">{{ $contact->message }}</div>
                    </div>
                    {{-- <div class="py-2 border-bottom">{{ $contact->message }}, {{$contact->apartment->title}}</div> --}}
                @endforeach
            </div>
        </div>
    </div>



@endsection