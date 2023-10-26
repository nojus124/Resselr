<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'Email' => 'required|email',
            'Password' => 'required',
        ]);
        Log::info('Admin details: ' . $request->input('Email'). 'password: '. $request->input('Password'));
        $credentials = [
            'Email' => $request->input('Email'), // Map 'Email' to 'username'
            'password' => $request->input('Password'), // Map 'Password' to 'password'
        ];

        if (Auth::guard('admin')->attempt($credentials,true)) {
            // Log successful login with email
            Log::info('Admin logged in successfully: ' . $request->input('Email'));

            // Check if the user is logged in
            if (Auth::guard('admin')->check()) {
                // Log user details
                Log::info('Admin details: ' . Auth::guard('admin')->user());
            }

            return redirect()->route('admin.dashboard'); // Redirect admin to the admin dashboard
        }

        Log::warning('Admin login failed for email: ' . $request->input('Email'));

        return redirect()->route('AdminLogin');
    }
}
