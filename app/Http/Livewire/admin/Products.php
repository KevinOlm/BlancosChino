<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $searchField = '';
    public $sort = 'product_variations.id';
    public $direction = 'desc';
    public $sortOptions = [
        'product_variations.id',
        'product_variations.name',
        'product_variations.price',
        'product_variations.offerActive',
        'product_variations.stock',
        'product_variations.amountPurchased',
        'product_variations.created_at',
        'products.groupName',
        'products.calification',
        'sizes.size',
        'categories.category',
    ];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteProductConfirmation'];

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

    public function deleteProduct($id = 0) {
        if($id > 0) $this->emit('deleteProduct', $id);
    }

    public function deleteProductConfirmation($id = 0) {
        $deletedProduct = null;
        if($id > 0) $deletedProduct = ProductVariation::find($id);
        if($deletedProduct) {
            $deletedProduct->delete();
        }
    }

    public function render() {
        $products = DB::table('product_variations')
            ->join('products', 'products.id', '=', 'product_variations.product_id')
            ->join('sizes', 'sizes.id', '=', 'product_variations.size_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select(
                'product_variations.*',
                'products.groupName',
                'products.calification',
                'products.calificationNumber',
                'sizes.size',
                'categories.category'
            )
            ->where('product_variations.id', 'like', '%' . $this->searchField . '%')
            ->orWhere('product_variations.name', 'like', '%' . $this->searchField . '%')
            ->orWhere('product_variations.price', 'like', '%' . $this->searchField . '%')
            ->orWhere('product_variations.created_at', 'like', '%' . $this->searchField . '%')
            ->orWhere('products.groupName', 'like', '%' . $this->searchField . '%')
            ->orWhere('sizes.size', 'like', '%' . $this->searchField . '%')
            ->orWhere('categories.category', 'like', '%' . $this->searchField . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(20);

        return view('livewire.admin.products', compact('products'));
    }
}
