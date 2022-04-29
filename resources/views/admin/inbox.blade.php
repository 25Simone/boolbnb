@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="card p-3">
            <div class="row">
                @foreach ($contacts as $contact)
                    <div class="py-2 border-bottom">{{ $contact->message }} {{}}</div>
                @endforeach
            </div>
        </div>
    </div>



@endsection