<?php

namespace Mamta\Contactform\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mamta\Contactform\Mail\ContactMessageMail;
use Mamta\Contactform\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        return view('contactform::index');
    }

    public function saveMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'subject' => 'required|max:100',
            'message' => 'required|max:250',
        ]);
        $data = $request->except(['_token']);
        $contactMessage = ContactMessage::create($data);

        Mail::to('demo@demo.com')->send(new ContactMessageMail($contactMessage));

        if ($contactMessage) {
            return redirect()->route('contact-form.index')->with('success', __('contactform::message.form_save_success'));
        } else {
            return redirect()->route('contact-form.index')->with('error', __('contactform::message.form_save_error'));
        }
    }
}
