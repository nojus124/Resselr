<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // Import the Str facade
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        // Validate the input data
        $validated = Validator::make($request->all(), [
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users',
            'Password' => 'required|string|min:8', // Adjust this to your security requirements
            'DateOfBirth' => 'required|date',
            'PhoneNumber' => 'required|string|max:20', // Adjust this to your requirements
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validated->errors(),
            ]);
        } else{
            $validatedData = $validated->validated(); // Get the validated data
            $user = new User();
            $user->FirstName = $validatedData['FirstName'];
            $user->LastName = $validatedData['LastName'];
            $user->Email = $validatedData['Email'];
            $user->Password = bcrypt($validatedData['Password']);
            $user->DateOfBirth = $validatedData['DateOfBirth'];
            $user->PhoneNumber = $validatedData['PhoneNumber'];
            $user->save();;

            // Create a response with a cookie
            $response = redirect()->route('home');
        }

        return $response;
    }
}
