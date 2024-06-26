<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $req){
        //$contact = Contact::all()->reverse(); for return all columns
        $contact = Contact::select('id', 'name','phone', 'email')->get()->reverse(); // To return only selected table fields.

        return  view('contacts')->with("contact",$contact);
    }
    public function add(Request $req){
        $contact = new Contact;
        $contact->email = $req->email;
        $contact->phone = $req->phone;
        $contact->name = $req->name;
        $contact->save();
        return redirect()->back();
    }
    public function delete(Request $req){
        $contact = Contact::find($req->id);
        $contact->delete();
        return redirect()->back();
    }
    // Method to display the edit form
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // Method to update the contact
    public function update(Request $req){
        $contact = Contact::find($req->id);
        $contact->update([
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
        ]);
    
        // Return updated contact data
        return response()->json(['contact' => $contact]);
    }
    
}