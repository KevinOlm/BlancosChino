<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $spetialProduct = ProductVariation::orderBy('amountPurchased', 'desc')->first();
        $spetialOffers = ProductVariation::where('offerActive', '=', '1')
            ->orderBy('amountPurchased', 'desc')
            ->take(4)
            ->get();
        $categories = Category::where('category', 'not like', 'Sin Categoría')->get();

        return view('home', compact('spetialProduct', 'spetialOffers', 'categories'));
    }
}
