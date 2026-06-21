<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmation;
use App\Mail\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontaktController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:5000'],
        ]);
        Mail::to(config('mail.from.address'))->send(new ContactInquiry(
            name: $validated['name'],
            email: $validated['email'],
            phone: $validated['phone'],
            body: $validated['message'],
        ));

        Mail::to($validated['email'])->send(new ContactConfirmation(
            name: $validated['name'],
            body: $validated['message'],
        ));

        return redirect()->to('/#kontakt')->with('success', 'Zpráva byla odeslána. Brzy se vám ozveme!');
    }
}
