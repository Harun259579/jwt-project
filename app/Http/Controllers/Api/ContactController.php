<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\About\Community;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        // Store
        $contact = Contact::create($request->all());

        // Send Email To Sender
        Mail::send('backend.emails.contact-reply', [
            'name' => $request->name,
            'message_input' => $request->message
        ], function ($msg) use ($request) {
            $msg->to($request->email);
            $msg->subject("Thanks for contacting us");
        });

        return response()->json([
            'status' => true,
            'message' => 'Contact submitted successfully',
            'data' => $contact
        ], 201);
    }

    public function communityStore(Request $request)
    {
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:communities,email',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create a new subscription record
        $subscription = Community::create([
            'email' => $request->email
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Subscribed successfully!',
            'data' => $subscription
        ], 201);
    }
}
