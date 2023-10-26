<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemConditions;
use Livewire\Component;

class MarketplaceItem extends Component
{
    public Item $item;
    public $Name;
    public $id;
    public $index;

    public function mount(Item $item, $index)
    {
        $this->item = $item;
        $this->Name = $item->ItemName;
        $this->id= $item->id;
        $this->index= $index;
    }
    public function triggerChangeData($id)
    {
        $this->dispatch('callChangeData', $id);
    }
    public function render()
    {
        return view('livewire.marketplace-item');
    }
}
