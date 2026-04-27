<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $contact = Contact::create($validated);

        // Send email notification to portfolio owner
        Mail::to(auth()->check() ? auth()->user()->email : env('MAIL_FROM_ADDRESS'))
            ->send(new \App\Mail\ContactMail($contact));

        return redirect()->back()
            ->with('success', 'Message sent successfully! I will get back to you soon.');
    }

    public function adminIndex()
    {
        $this->authorize('isAdmin');
        $messages = Contact::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Contact $contact)
    {
        $this->authorize('isAdmin');
        $contact->update(['is_read' => true]);
        return view('admin.messages.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('isAdmin');
        $contact->delete();
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully!');
    }
}
