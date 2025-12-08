<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('backend.contact.index', compact('contacts'));
    }
    public function reply($id)
{
    $contact = Contact::findOrFail($id);
    return view('backend.contact.reply', compact('contact'));
}

public function sendReply(Request $request)
{
    Mail::raw($request->message, function ($msg) use ($request) {
        $msg->to($request->email);
        $msg->subject('Reply from Admin');
    });

    return redirect()->route('admin.contacts')->with('success', 'Reply sent successfully!');

   // Mail::to($request->email)->send(
       // new AdminReplyMail(
           // $request->name,          
           // $request->user_message,  
           // $request->message       
       // )
   // );

   // return redirect()->route('admin.contacts')->with('success', 'Reply sent successfully!');
  
}

public function delete($id)
{
    Contact::findOrFail($id)->delete();

    return redirect()->back()->with('success', 'Contact deleted successfully!');
}



}
