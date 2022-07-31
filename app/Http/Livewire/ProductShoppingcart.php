<?php

namespace App\Http\Livewire;

use App\Models\CartSession;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductShoppingcart extends Component
{
    public $item;
    public $quantity;

    public function mount($item) {
        if(Auth::check()) $this->item = $item;
        else $this->item = $item->id;
        $this->quantity = $item->quantity;
    }

    public function updatedQuantity() {
        $this->quantity = intval($this->quantity);
        if ($this->quantity < 1) $this->quantity = 1;
        if(Auth::check()) {
            if($this->quantity > $this->item->product->stock) $this->quantity = $this->item->product->stock;
            $this->item->quantity = $this->quantity;
            $this->item->subtotal = $this->quantity * $this->item->product->price;
            $this->item->save();
        }
        else {
            $product = ProductVariation::find($this->item);
            $oldCart = (session()->has('cart'))? session('cart'): null;
            $cart = new CartSession($oldCart);
            $cart->update($product, $this->quantity);
            $this->quantity = $cart->items[$this->item]->quantity;
            session(['cart' => $cart]);
        }

        $this->emit('render');
    }

    public function deleteCartProduct() {
        if(Auth::check()) $this->item->delete();
        else {
            $oldCart = (session()->has('cart'))? session('cart'): null;
            $cart = new CartSession($oldCart);
            $cart->delete($this->item);
            session(['cart' => $cart]);
        }

        $this->emit('render');
    }

    public function render() {
        if(Auth::check()) $renderedItem = $this->item;
        else $renderedItem = (array_key_exists($this->item, session('cart')->items))? session('cart')->items[$this->item] : [];

        return view('livewire.product-shoppingcart', compact('renderedItem'));
    }
}
