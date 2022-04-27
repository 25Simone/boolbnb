<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\NewApartmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            "name" => "required|string|min:3",
            "lastname" => "required|string|min:3",
            "email" => "email|required",
            "message" => "string|required",
            "apartment_id" => "exists:apartments,id|integer"
        ]);
        dump('ciao');

        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save();

        Mail::to(Auth::user()->email)->send(new NewApartmentMail($newContact)); 
        return response()->json($newContact);
    }
}
