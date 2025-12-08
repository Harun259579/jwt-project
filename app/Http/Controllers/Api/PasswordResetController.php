<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Mail\OtpMail;

class PasswordResetController extends Controller
{
    // Send OTP to user's email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999); // Generate 6-digit OTP

        // Store OTP in cache for 5 minutes
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));

        // Send OTP via email
        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to your email.'
        ]);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        $cachedOtp = Cache::get('otp_' . $request->email);

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired or not found.'
            ], 422);
        }

        if ($request->otp == $cachedOtp) {
            // OTP verified, allow password reset
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.'
            ], 422);
        }
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|confirmed|min:8',
        ]);

        // Verify OTP again before updating password
        $cachedOtp = Cache::get('otp_' . $request->email);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.'
            ], 422);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Clear OTP from cache
        Cache::forget('otp_' . $request->email);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!'
        ]);
    }
}
