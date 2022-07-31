<?php

namespace App\Http\Livewire;

use App\Models\PurchasedProduct;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Purchases extends Component
{
    public $purchases;
    public $selectedDetails;
    public $purchaseDetails;

    public function mount() {
        $this->purchases = PurchaseOrder::where('user_id', '=', Auth::user()->id)->get();
    }

    public function details($id = 0) {
        if($id > 0) $this->purchaseDetails = PurchasedProduct::where('purchase_order_id', '=', $id)->get();
        if($this->purchaseDetails) {
            $this->selectedDetails = $id;
            $this->emit('fixedResize');
        }
    }

    public function hideDetails() {
        $this->selectedDetails = null;
        $this->purchaseDetails = null;
    }

    public function render() {
        return view('livewire.purchases');
    }
}
