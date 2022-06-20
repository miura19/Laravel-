<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\storeContact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(storeContact $request)
    {
        $contact = new Contact();
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->body = $request->input('body');
        $title = $request->input('title');
        $email = $request->input('email');
        $body = $request->input('body');
        $inputs = [
            'title' => $title,
            'email' => $email,
            'body' => $body,
        ];
        $contact->save();
     
        Mail::to(config('mail.admin'))->send(new ContactMail($inputs)); 
        Mail::to($email)->send(new ContactMail($inputs)); 
        return back()->with([
            'store_contact_success' => 'お問い合わせ内容を送信したよっっ！///'
        ]);
    }
}
