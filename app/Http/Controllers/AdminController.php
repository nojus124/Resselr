<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Review;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function deleteUser(request $request)
    {
        $id = $request->query('id');
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
    public function deleteTransaction(request $request)
    {
        $id = $request->query('id');
        $transaction = Transactions::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }
    public function deleteItem(request $request)
    {
        $id = $request->query('id');
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $item->images()->delete();
        $item->transactions()->delete();
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }
    public function deleteReview(request $request)
    {
        $id = $request->query('id');
        $review= Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
    public function getUsers(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 20);
        $users = User::paginate($perPage, ['*'], 'page', $page);
        $totalUsers = User::count();

        return response()->json([
            'data' => $users,
            'total' => $totalUsers,
        ]);
    }
    public function getTransactions(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 20);

        $transactions = DB::table('transactions')
        ->select('*')
            ->paginate($perPage, ['*'], 'page', $page);

        $totalTransactions = DB::table('transactions')->count();

        return response()->json([
            'data' => $transactions,
            'total' => $totalTransactions,
        ]);
    }
    public function getItems(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 20);

        $items = Item::paginate($perPage, ['*'], 'page', $page);
        $totalItems = Item::count();

        return response()->json([
            'data' => $items,
            'total' => $totalItems,
        ]);
    }

    public function getReviews(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 20);

        $reviews = Review::paginate($perPage, ['*'], 'page', $page);
        $totalReviews = Review::count();

        return response()->json([
            'data' => $reviews,
            'total' => $totalReviews,
        ]);
    }
    public function submitUsers(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'nullable', // 'id' is now nullable
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required|email',
            'Password' => 'required',
            'PhoneNumber' => 'required',
            'City' => 'required',
            'Street' => 'required',
            'StreetNumber' => 'required',
        ]);

        $user = $validatedData['id'] ? User::find($validatedData['id']) : new User();

        $user->FirstName = $validatedData['FirstName'];
        $user->LastName = $validatedData['LastName'];
        $user->Email = $validatedData['Email'];
        $user->Password = $validatedData['Password'];
        $user->PhoneNumber = $validatedData['PhoneNumber'];
        $user->City = $validatedData['City'];
        $user->Street = $validatedData['Street'];
        $user->StreetNumber = $validatedData['StreetNumber'];

        $user->save();

        return response()->json(['message' => 'User data submitted successfully'], $validatedData['id'] ? 200 : 201);
    }

    public function submitTransaction(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'nullable', // 'id' is now nullable
            'BuyerID' => 'required',
            'SellerID' => 'required',
            'ItemID' => 'required',
            'TransactionDate' => 'required',
            'TransactionStatus' => 'required',
        ]);

        $transaction = $validatedData['id'] ? Transactions::find($validatedData['id']) : new Transactions();

        $transaction->BuyerID = $validatedData['BuyerID'];
        $transaction->SellerID = $validatedData['SellerID'];
        $transaction->ItemID = $validatedData['ItemID'];
        $transaction->TransactionDate = $validatedData['TransactionDate'];
        $transaction->TransactionStatus = $validatedData['TransactionStatus'];

        $transaction->save();

        return response()->json(['message' => 'Transaction data submitted successfully'], $validatedData['id'] ? 200 : 201);
    }

    public function submitReview(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'nullable', // 'id' is now nullable
            'TransactionID' => 'required',
            'Rate' => 'required',
            'Description' => 'required',
        ]);

        $review = $validatedData['id'] ? Review::find($validatedData['id']) : new Review();

        $review->TransactionID = $validatedData['TransactionID'];
        $review->Rate = $validatedData['Rate'];
        $review->Description = $validatedData['Description'];

        $review->save();

        return response()->json(['message' => 'Review submitted successfully'], $validatedData['id'] ? 200 : 201);
    }

    public function submitItem(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'nullable', // 'id' is now nullable
            'SellerID' => 'required',
            'CategoryID' => 'required',
            'ItemName' => 'required',
            'Description' => 'required',
            'Price' => 'required',
            'Condition' => 'required',
            'UploadDate' => 'required',
        ]);

        $item = $validatedData['id'] ? Item::find($validatedData['id']) : new Item();

        $item->SellerID = $validatedData['SellerID'];
        $item->CategoryID = $validatedData['CategoryID'];
        $item->ItemName = $validatedData['ItemName'];
        $item->Description = $validatedData['Description'];
        $item->Price = $validatedData['Price'];
        $item->Condition = $validatedData['Condition'];
        $item->UploadDate = $validatedData['UploadDate'];

        $item->save();

        return response()->json(['message' => 'Item submitted successfully'], $validatedData['id'] ? 200 : 201);
    }


}
