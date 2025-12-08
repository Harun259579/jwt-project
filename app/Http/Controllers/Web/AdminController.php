<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->auth_user ?? null;

        return view('backend.layouts.admin.dashboard', compact('user'));
    }
}
