<?php

namespace App\Http\Livewire\Admin;

use App\Models\PurchasedProduct;
use App\Models\PurchaseOrder;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Purchases extends Component
{
    use WithPagination;

    public $searchField = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $sortOptions = [
        'id',
        'user_mail',
        'total',
        'status',
        'created_at',
    ];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['updateStateConfirmation'];

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

    public function updatedSearchField() {
        $this->resetPage();
    }

    public function updateState($id = 0) {
        $message = 'Todos los productos relacionados con esta compra serán modificados';
        if($id > 0) $this->emit('updateState', $id, $message);
    }

    public function updateStateConfirmation($id = 0, $state) {
        $purchaseOrder = null;
        if($id > 0) $purchaseOrder = PurchaseOrder::find($id);
        if($purchaseOrder) {
            $purchasedProducts = PurchasedProduct::where('purchase_order_id', '=', $purchaseOrder->id)->get();
            foreach($purchasedProducts as $purchasedProduct) {
                $purchasedProduct->status = $state;
                $purchasedProduct->save();
            }
            $purchaseOrder->status = $state;
            $purchaseOrder->save();
        }
    }

    public function showAddress($id = 0) {
        $userPurchase = null;
        if($id > 0) $userPurchase = User::find($id);
        if($userPurchase) {
            if(count($userPurchase->userAddresses) > 0) {
                $this->emit(
                    'showAddress',
                    $userPurchase->userAddresses->where('selected', true)->first(),
                    $userPurchase->phoneNumbers
                );
            }
            else $this->emit('noAddress');
        }
    }

    public function render() {
        $purchases = PurchaseOrder::
            where('id', 'like', '%' . $this->searchField . '%')
            ->orWhere('user_mail', 'like', '%' . $this->searchField . '%')
            ->orWhere('total', 'like', '%' . $this->searchField . '%')
            ->orWhere('status', 'like', '%' . $this->searchField . '%')
            ->orWhere('created_at', 'like', '%' . $this->searchField . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.purchases', compact('purchases'));
    }
}
