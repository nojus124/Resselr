<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemConditions;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{

    public $items = [];
    public $categories = [];
    public $conditions = [];
    public $title;
    public $category;
    public $price;
    public $images = [];
    public $description;
    public $orders;
    public $soldItems;

    protected $rules = [
        'title' => 'required|string',
        'category' => 'required|string',
        'condition' => 'required|string',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];


    public function mount()
    {
        $this->items = $this->items();
        $this->categories = $this->Categories();
        $this->conditions = $this->Conditions();
        $this->orders = $this->Orders();
        $this->soldItems = $this->soldItems();
    }
    public function refreshItems() : void{
        $this->items = $this->items();
    }
    public function Conditions(){
        $ConditionsNames = ItemConditions::pluck('Condition')->toArray();
        return $ConditionsNames;
    }
    public function Categories() {
        $categoryNames = Category::pluck('CategoryName')->toArray();

        return $categoryNames;
    }
    public function soldItems(){
        $user_id = auth()->user()->id;
        $orders = Transactions::where('SellerID', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return $orders;
    }
    public function Orders()
    {
        $user_id = auth()->user()->id;

        $orders = Transactions::where('BuyerID', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return $orders;
    }

    public function render()
    {
        return view('livewire.profile');
    }

    public function items()
    {
        $userID = Auth::user()->id;
        $items = Item::where('SellerID', $userID)->get();
        return $items;
    }

    public function delete($itemId)
    {
        Item::find($itemId)->delete();
    }
}
