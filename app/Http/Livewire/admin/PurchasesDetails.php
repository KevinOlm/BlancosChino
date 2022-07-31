<?php

namespace App\Http\Livewire\Admin;

use App\Models\PurchasedProduct;
use App\Models\PurchaseOrder;
use Livewire\Component;
use Livewire\WithPagination;

class PurchasesDetails extends Component
{
    use WithPagination;

    public $searchField = '';
    public $orderId;
    public $sort = 'id';
    public $direction = 'desc';
    public $sortOptions = ['id', 'purchased_name', 'purchased_price', 'quantity', 'subtotal', 'status', 'created_at'];

    protected $listeners = ['updateStateConfirmation'];
    protected $paginationTheme = 'bootstrap';

    public function mount($id) {
        $this->orderId = $id;
    }

    public function updatedSearchField() {
        $this->resetPage();
    }

    public function sort($order) {
        if($this->sort === $order) {
            if($this->direction === 'asc') $this->direction = 'desc';
            else $this->direction = 'asc';
        }
        else if (in_array($order, $this->sortOptions)) {
            $this->sort = $order;
            $this->direction = 'asc';
        }
    }

    public function updateState($id = 0) {
        if($id > 0) $this->emit('updateState', $id);
    }

    public function updateStateConfirmation($id = 0, $state) {
        $updatedPurchasedProduct = null;
        if($id > 0) $updatedPurchasedProduct = PurchasedProduct::find($id);
        if($updatedPurchasedProduct) {
            $updatedPurchasedProduct->status = $state;
            $updatedPurchasedProduct->save();
            $purchasedProducts = PurchasedProduct::where('purchase_order_id', '=', $this->orderId)->get();
            $sameState = true;
            foreach($purchasedProducts as $purchasedProduct) {
                if($purchasedProduct->status !== $state) {
                    $sameState = false;
                    break;
                }
            }
            if($sameState) {
                $updatedPurchasedProduct->purchaseOrder->status = $state;
                $updatedPurchasedProduct->purchaseOrder->save();
            }
        }
    }

    public function render() {
        $purchasesDetails = PurchasedProduct::
            where('purchase_order_id', '=', $this->orderId)
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->searchField . '%')
                    ->orWhere('purchased_name', 'like', '%' . $this->searchField . '%')
                    ->orWhere('purchased_price', 'like', '%' . $this->searchField . '%')
                    ->orWhere('quantity', 'like', '%' . $this->searchField . '%')
                    ->orWhere('subtotal', 'like', '%' . $this->searchField . '%')
                    ->orWhere('status', 'like', '%' . $this->searchField . '%')
                    ->orWhere('created_at', 'like', '%' . $this->searchField . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.purchases-details', compact('purchasesDetails'));
    }
}
