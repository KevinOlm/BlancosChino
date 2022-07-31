<?php

namespace App\View\Components;

use App\Models\Image;
use App\Models\Product;
use Illuminate\View\Component;

class CategoryHome extends Component
{
    public $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products = Product::select('id')->where('category_id', '=', $this->category->id)->take(3)->get();
        $productImages = [];
        foreach($products as $product) {
            array_push($productImages, Image::where('product_id', '=', $product->id)->get());
        }

        return view('components.category-home', compact('productImages'));
    }
}
