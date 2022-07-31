<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use App\Notifications\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function home() {
        return view('contact');
    }

    public function send(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $mail = new ContactMailable($request->all());
        $mail->subject('Correo de Contacto');
        Mail::to('blancoselchinosj@gmail.com')->send($mail);

        return redirect()->route('contact');
    }
}
