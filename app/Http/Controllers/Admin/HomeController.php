<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function users() {
        return view('admin.users');
    }

    public function products() {
        return view('admin.products');
    }

    public function productCreate() {
        return view('admin.productCreate');
    }

    public function productEdit($id) {
        $product = ProductVariation::find($id);
        return view('admin.productEdit', compact('product'));
    }

    public function comments() {
        return view('admin.comments');
    }

    public function purchases() {
        return view('admin.purchases');
    }

    public function purchasesDetails($id) {
        return view('admin.purchasesDetails', compact('id'));
    }

    public function categories() {
        return view('admin.categories');
    }

    public function sizes() {
        return view('admin.sizes');
    }
}
