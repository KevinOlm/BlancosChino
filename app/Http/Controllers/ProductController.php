<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products() {
        return view('products');
    }

    public function productOverview($product) {
        if($product) {
            $product = ProductVariation::where('slug', 'like',  $product)->first();
            if($product) $productGeneral = Product::where('id', '=', $product->product_id)->first();
            else {
                $product = null;
                $productGeneral = null;
            }
        }
        else {
            $product = null;
            $productGeneral = null;
        }

        return view('product-overview', compact('product', 'productGeneral'));
    }
}
