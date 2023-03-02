<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //contact list
    public function contactList() {
        $contacts = Contact::orderBy('id','desc')->paginate(5);
        //   $contacts->appends(request()->all());        
          return view('admin.contact.list', compact('contacts'));
    }
    // contact
    public function contactPage() {
        return view('user.contact.form');
    }

    public function createContact(Request $request) {
        $this->contactValidationCheck($request);
        Contact::create($request->all());
        return redirect()->back()->with(['successContact' => 'Please wait . We are checking your message.']);

    }

    // contact validation check
    private function contactValidationCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required|min:6',
        ], [
            'name.required' => 'name ထည့်ရန်',
            'email.required' => 'email ထည့်ရန်',
            'message.required' => 'message ထည့်ရန်',
            'message.min' => 'message အနည်းဆုံး ၆ လုံးပြည့်အောင် ထည့်ရန်',
        ])->validate();
    }

}