<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\OtpMail; // Email sending class

class PasswordResetController extends Controller
{
    // Show the password reset form
    public function showResetForm()
    {
        return view('backend.auth.passwords.reset');
    }

    // Send OTP to user's email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        // Store OTP in session or database (this is session based)
        session(['otp' => $otp, 'email' => $request->email]);

        // Send OTP via email (using a Mailable)
        Mail::to($user->email)->send(new OtpMail($otp));

       return view('backend.auth.passwords.verify-otp')->with('status', 'OTP has been sent.');


    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if ($request->otp == session('otp')) {
            return view('backend.auth.passwords.reset-password'); // Show password reset form
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', session('email'))->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Clear OTP session
        session()->forget(['otp', 'email']);

        return redirect()->route('login')->with('message', 'Password updated successfully!');
    }
}
