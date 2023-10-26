<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    public function loginService(Request $request)
    {
        $credentials = array(
            'Email' => $request->Email,
            'Password' => $request->Password,
        );
        $user = User::whereEmail($request->Email)->first();
        if($user && Hash::check($request->Password, $user->Password)){
            Auth::login($user);
            if(Auth::check()){
                return redirect()->route('home');
            }
            else{
                return "error";
            }
        }
        else{
            return "error";
        }
    }

    public function ajaxLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
