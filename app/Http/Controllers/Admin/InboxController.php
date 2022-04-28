<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index(){
        $contacts= Contact::all();
        return view('admin.inbox',compact("contacts"));
    }
}
