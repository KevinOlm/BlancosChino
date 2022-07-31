<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $categories;
    public $category = 'Cualquiera';
    public $categoryNames;
    public $loaded = false;
    public $sort = 'id-desc';
    public $sortOptions = [
        'id-desc',
        'id-asc',
        'name-asc',
        'name-desc',
        'price-asc',
        'price-desc',
        'amountPurchased-desc',
    ];

    protected $queryString = [
        'category' => ['except' => 'Cualquiera'],
        'sort' => ['except' => 'id-desc'],
        'search' => ['except' => ''],
    ];

    public function mount() {
        $this->categories = Category::where('category', 'not like', 'sin categoría')->get();
        $this->categoryNames = $this->categories->pluck('category')->toArray();
        if(!in_array($this->category, $this->categoryNames)) $this->category = 'Cualquiera';
        if(!in_array($this->sort, $this->sortOptions)) $this->sort = 'id-desc';
    }

    public function pageLoaded() {
        $this->loaded = true;
    }

    public function updatedCategory() {
        if(!in_array($this->category, $this->categoryNames)) $this->category = 'Cualquiera';
        $this->resetPage();
    }

    public function updatedSort() {
        if(!in_array($this->sort, $this->sortOptions)) $this->sort = 'id-desc';
        $this->resetPage();
    }

    public function render() {
        $products = [];
        if($this->loaded) {
            $sortarray = explode('-', $this->sort);
            if ($this->category !== 'Cualquiera') {
                $selectedCategory = Category::where('category', 'like', $this->category)->first();
                $selectedProducts = Product::where('category_id', '=', $selectedCategory->id)->pluck('id');
                $products = ProductVariation::
                    whereIn('product_id', $selectedProducts)
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orderBy($sortarray[0], $sortarray[1])
                    ->paginate(12);
            }
            else $products = ProductVariation::
                where('name', 'like', '%' . $this->search . '%')
                ->orderBy($sortarray[0], $sortarray[1])
                ->paginate(12);
        }
        else $products = [];

        return view('livewire.products', compact('products'));
    }
}
