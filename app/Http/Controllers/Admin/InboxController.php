<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index(){
        // Save contacts from db
        $contacts= Contact::all();
        // Load the apartment data
        $contacts->load('apartment');
        return view('admin.inbox',compact("contacts"));
    }

    public function destroy($id){
        $contact = Contact::findOrFail($id);
        // Delete contact
        $contact->delete();
        return redirect()->route('admin.inbox');
    }
}
