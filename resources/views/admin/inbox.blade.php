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
                            <div class="d-flex flex-column align-items-end">
                                {{ $contact->email }}
                                <form action="{{ route('admin.inbox.destroy', $contact->id) }}" method="post" id="delete_button_{{$contact->id}}">
                                    @csrf
                                    @method('delete')
                                
                                    <button class="rounded text-light delete-button shadow mt-3" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                            Details
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">{{ $contact->message }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection