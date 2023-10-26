<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => [
                'required',
                'email',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
            ],
        ];

        $messages = [
            'FirstName.required' => 'The first name field is required.',
            'LastName.required' => 'The last name field is required.',
            'Email.required' => 'The email field is required.',
            'Email.email' => 'Please provide a valid email address.',
            'Email.unique' => 'The email address is already in use by another user.',
        ];

        try {
            // Validate the request data
            $validatedData = $request->validate($rules, $messages);

            $user->update($validatedData);

            return response()->json(['message' => 'Profile updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    public function updateOrderRating(Request $request)
    {
        $user = auth()->user();
        $itemId = $request->input('Id');

        // Find the transaction for the specified item ID
        $transaction = $user->transactions()
            ->where('ItemID', $itemId)
            ->first();

        if ($transaction) {
            // Check if a review exists for this transaction
            $review = Review::where('TransactionID', $transaction->id)->first();

            if ($review) {
                $review->update([
                    'Rate' => $request->input('Rating'),
                    'Description' => $request->input('Description')
                ]);
            } else {
                $review = new Review([
                    'TransactionID' => $transaction->id,
                    'Rate' => $request->input('Rating'),
                    'Description' => $request->input('Description')
                ]);
                $review->save();
            }

            return response()->json(['message' => 'Review updated successfully', 'transaction' => $transaction]);
        } else {
            // Transaction not found, handle the case where the transaction is not found
            return response()->json(['error' => 'Transaction not found or does not belong to the user'], 404);
        }
    }


}
