<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemConditions;
use App\Models\Transactions;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Livewire\Livewire;
use Illuminate\Support\Facades\Validator;

class MarketplaceController extends Controller
{
    public function searchItems(Request $request)
    {
        $search = $request->input('search', '');
        $categoryIds = $request->input('categories', []);

        $query = Item::query();

        if ($search !== '') {
            $query->where('ItemName', 'like', '%' . $search . '%');
        }

        if (!empty($categoryIds)) {
            $query->whereIn('CategoryID', $categoryIds);
        }
        $query->where('availability', 1);
        $page = $request->input('page', 1);
        $resultsPerPage = 20;

        $skip = ($page - 1) * $resultsPerPage;
        $items = $query->with('category', 'images', 'itemcondition')
            ->skip($skip)
            ->take($resultsPerPage)
            ->get();

        return response()->json(['items' => $items]);
    }
    public function getCategoryList(Request $request)
    {
        $categories = Category::pluck('CategoryName')->all();
        return response()->json($categories);
    }
    public function fetchConditionsList(Request $request0){
        $conditions = ItemConditions::pluck('Condition');
        return response()->json($conditions);
    }
    public function deleteUserItem(Request $request){
        $itemID = $request->input('ItemID');
        $userID = auth()->user()->id;

        $item = Item::where('id', $itemID)
            ->where('SellerID', $userID)
            ->first();

        if ($item) {
            $transactions = $item->transactions;

            foreach ($transactions as $transaction) {
                $transaction->reviews()->delete();
                $transaction->delete();
            }

            $item->images()->delete();
            $item->delete();

            return response()->json(['message' => 'Item deleted successfully']);
        } else {
            return response()->json(['message' => 'Item not found or you do not have permission to delete it'], 404);
        }
    }
    public function getUserItem(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $itemId = $request->input('ItemID');

        if (!$itemId) {
            return response()->json(['message' => 'ItemID is missing in the request'], 400);
        }

        $item = $user->itemsSold->find($itemId);

        if ($item) {
            $images = $item->images;
            $imageUrls = $images->pluck('ImageURL');

            $itemData = $item->toArray();
            $itemData['images'] = $imageUrls;

            return response()->json(['item' => $itemData]);
        } else {
            return response()->json(['message' => 'Item not found for the user'], 404);
        }
    }
    public function updateDataForm(Request $request){
        $rules = [
            'Title' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Description' => 'required|string',
            'Category' => 'required|string',
            'Condition' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $itemId = $request->input('ItemID');

        if (!$itemId) {
            return response()->json(['message' => 'ItemID is missing in the request'], 400);
        }

        $item = $user->itemsSold->find($itemId);

        if (!$item) {
            return response()->json(['message' => 'Item not found for the user'], 404);
        }
        $categoryName = $request->input('Category');
        $category = Category::where('CategoryName', $categoryName)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $ConditionName = $request->input('Condition');
        $condition = ItemConditions::where('Condition', $ConditionName)->first();

        if (!$condition) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $item->update([
            'ItemName' => $request->input('Title'),
            'Price' => $request->input('Price'),
            'Description' => $request->input('Description'),
            'Category' => $category->id,
            'Condition' => $condition->id,
        ]);
        if ($request->hasFile('Images')) {
            $images = [];
            $imageUrls = $item->images->pluck('ImageURL')->toArray();
            foreach ($imageUrls as $imageUrl) {
                $imagePath = public_path($imageUrl);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $item->images()->delete();
            foreach ($request->file('Images') as $index => $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/MarketplaceImages'), $imageName);
                $imageUrl = 'img/MarketplaceImages/' . $imageName;
                $images[$index] = $imageUrl;
                $item->images()->create(['ImageURL' => $imageUrl]);
            }
        }

        return response()->json(['item' => $item]);
    }
    public function submitAddItem(Request $request){
        $rules = [
            'Title' => 'required|string|max:255',
            'Category' => 'required|string|max:255',
            'Condition' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Description' => 'required|string',
            'Location' => 'required|string',
            'Images.*' => 'required|file|mimes:jpeg,jpg,png'

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $category = Category::where('CategoryName', $data['Category'])->first();
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $condition = ItemConditions::where('Condition', $data['Condition'])->first();
        if (!$category) {
            return response()->json(['error' => 'Condition not found'], 404);
        }

        $item = new Item([
            'SellerID' => auth()->user()->id,
            'CategoryID' => $category->id,
            'ItemName' => $data['Title'],
            'Location' =>$data['Location'],
            'Description' => $data['Description'],
            'Price' => $data['Price'],
            'Condition' => $condition->id,
            'UploadDate' => now(),
        ]);
        $item->save();
        if ($request->hasFile('Images')) {
            $images = [];

            foreach ($request->file('Images') as $index => $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/MarketplaceImages'), $imageName);
                $imageUrl = 'img/MarketplaceImages/' . $imageName;
                $images[$index] = $imageUrl;
                $item->images()->create(['ImageURL' => $imageUrl]);
            }
        }
        return response()->json(['message' => 'Item created successfully'], 201);
    }
    public function mostRecentMain(Request $request)
    {
        $items = Item::with('images')
        ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json($items);
    }
    public function ShowItemPage(Request $request, $id){
        $item = Item::find($id);
        if (!$item) {
            abort(404);
        }
        $Seller = User::find($item->SellerID);
        $category = $item->Category;
        $images = $item->Images;
        return view('MainMarketplaceItemshow/MainPageItem', ['item' => $item, 'category' => $category, 'images' => $images, 'Seller' => $Seller] );
    }
}
