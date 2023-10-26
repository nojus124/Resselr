<?php

namespace App\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SearchBar extends Component
{
    public $search = '';
    public $transport = false;
    public $realEstate = false;
    public $jobsServices = false;
    public $household = false;
    public $computers = false;
    public $communication = false;
    public $electronics = false;
    public $entertainment = false;
    public $clothingFootwear = false;
    public $forParents = false;
    public $selectedCategories = [];
    public $page = 1;
    public $items = [];

    public function updateItems(){
        $categories = [
            '1' => $this->transport,
            '2' => $this->realEstate,
            '3' => $this->jobsServices,
            '4' => $this->household,
            '5' => $this->computers,
            '6' => $this->communication,
            '7' => $this->electronics,
            '8' => $this->entertainment,
            '9' => $this->clothingFootwear,
            '10' => $this->forParents,
        ];
        $this->selectedCategories = array_keys(array_filter($categories));
        try {
            $response = Http::get('http://daiktusvetaine.test/api/items', [
                'search' => $this->search,
                'categories' => $this->selectedCategories,
                'page' => $this->page,
            ]);

            if ($response->successful()) {
                $this->items = $response->json()['items'];
            } else {
                return Redirect::route('error');
            }
        } catch (\Exception $e) {
            return Redirect::route('error');
        }
    }
    public function updateSearch(){
        $this->updateItems();
    }
    public function render()
    {
        $this->updateItems();
        return view('livewire.search-bar');
    }
}
