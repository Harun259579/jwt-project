<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\About\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    // Show all subscriptions
    public function index()
    {
        $subscriptions = Community::orderBy('id', 'DESC')->get();
        return view('backend.about.community.index', compact('subscriptions'));
    }

    // Store subscription (AJAX)
    public function communityStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:communities,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $subscription = Community::create([
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscribed successfully!',
            'data' => $subscription
        ], 201);
    }

    // Delete subscription
    public function destroy($id)
    {
        $subscription = Community::findOrFail($id);
        $subscription->delete();

        return redirect()->back()->with('success', 'Subscription deleted successfully.');
    }
}
