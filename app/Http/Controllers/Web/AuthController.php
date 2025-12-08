<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() 
    {
        if (auth()->check()) {

            // If already logged in → redirect based on role
            return $this->redirectBasedOnRole(auth()->user());
        }

        return view('backend.auth.login');
    }  
    
    public function webLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $user = auth()->user();

        //  redirect role based
        return $this->redirectBasedOnRole($user);
    } 

    public function webLogout()
    {
        auth()->logout();
        return redirect('/login');
    }

    
    // NEW METHOD: Role Based Redirect
    
    private function redirectBasedOnRole($user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('coach')) {
            return redirect()->route('blog.index');
        } 
        if ($user->hasRole('runner')) {
            return redirect()->route('blog.index');
        }

        // without role
        return redirect('/');
    }
}
