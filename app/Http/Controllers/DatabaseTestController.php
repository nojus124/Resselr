<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseTestController extends Controller
{
    public function testConnection()
    {
        // Create a new user instance
        $user = new User();

        // Set values for each column
        $user->FirstName = 'John';
        $user->LastName = 'Doe';
        $user->Email = 'johndoe@example.com';
        $user->Password = bcrypt('password123'); // Hash the password
        $user->DateOfBirth = '1990-01-15'; // Date format: yyyy-mm-dd
        $user->PhoneNumber = '1234567890';
        $user->City = 'New York';
        $user->Street = '123 Main St';
        $user->StreetNumber = 'Apt 4B';
        $user->SessionCookie = 'abc123';

        // Save the new user to the database
        $user->save();
        $users = User::all();

        // Return the users as JSON
        return response()->json(['users' => $users]);
    }
}
