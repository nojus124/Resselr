<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{
    public function getNewtoken(Request $request){
        $token = '';
        if(Auth::check()){
            $user = Auth::user();
            $this->ClearTokens();
            $token = $user->createToken('MarketplaceApi')->plainTextToken;
        }
        else{
            return response()->json([
                'error' => 'User is not logged in.',
            ]);
        }
        return response()->json([
            'token' => $token,
        ]);
    }
    public function ClearTokens()
    {
        auth()->user()->tokens()->delete();
    }
}
