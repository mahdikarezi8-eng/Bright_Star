<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // public function contact()
    // {
    //     $contact = Contact::first();
    //     return view('webside.contact.contact',compact('contact'));
    // }
    public function contact()
{
    $contact = Contact::first();

    
    return view('webside.contact.contact', compact('contact'));
}


    public function contact_list(){
        $contact = Contact::all();
        return view('Admin.contact.contact_list',compact('contact'));
    }
    public function contact_add(){
        return view('Admin.contact.contact_add');
    }



    public function contact_save(Request $request){
        $request->validate([
            'office' => ['required','string'],
            'email' => ['required','email','unique:contacts,email'],
            'phone' => ['required','numeric'],
            'facebook' =>['required','string'],
            'instagram' =>['required','string']
        ]);

        $contact  = new Contact();
        $contact-> office = $request->office;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->facebook = $request->facebook;
        $contact->instagram = $request->instagram;

        $contact->save();
        return redirect()->route('contact_list')->with('success','Contact Inserted Successfully!'); 
    }



    public function contact_edit($id){
        $contact = Contact::find($id);
        return view('Admin.contact.contact_edit',compact('contact'));
    }


    public function contact_update(Request $request,$id){
        $contact = Contact::find($id);
        $request->validate([
            'office' => ['required','string'],
            'email' => ['required','email','unique:contacts,email'],
            'phone' => ['required','numeric'],
            'facebook' =>['required','string'],
            'instagram' =>['required','string']
        ]);

        $contact-> office = $request->office;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->facebook = $request->facebook;
        $contact->instagram = $request->instagram;

        $contact->save();
        return redirect()->route('contact_list')->with('success','Contact Updated Successfully!'); 
    }


    public function contact_delete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('contact_list')->with('success','Contact Deleted Successfully!');  
    }




}
