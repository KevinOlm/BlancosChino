<?php

namespace App\Http\Livewire;

use App\Models\ProductVariation;
use Livewire\Component;

class Search extends Component
{
    public $open = false;
    public $searchValue = "";
    public $matchedProducts = [];

    public function updatedSearchValue() {
        if($this->searchValue) {
            $this->matchedProducts = ProductVariation::where('name', 'like', '%' . $this->searchValue . '%')
                ->orderBy('amountPurchased', 'desc')
                ->take(5)
                ->get();
            if(count($this->matchedProducts) > 0) $this->emit('fixedResize');
        }
        else {
            $this->matchedProducts = [];
        }
    }

    public function render() {
        return view('livewire.search');
    }
}
