<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('admin@example.com')
                ->subject('New Contact Message: ' . $request->subject)
                ->from($request->email, $request->name);
        });

        return back()->with('success', 'Your message has been sent successfully ✅');
    }
}
