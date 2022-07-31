<?php

namespace App\Actions\Fortify;

use App\Models\ProductVariation;
use App\Models\Shoppingcart;
use App\Models\ShoppingCartProduct;

class UpdateCartAfterLogin {

    public function __invoke($request, $next) {
        if(session()->has('cart')) {
            $cart = session('cart');
            $user = $request->user();

            foreach($cart->items as $cartProduct) {
                $product = ProductVariation::find($cartProduct->id);
                if($product) {
                    $existingProduct = ShoppingCartProduct::where([
                        ['product_variation_id', '=', $cartProduct->id],
                        ['shoppingcart_id', '=', $user->shoppingcart->id]
                    ])->first();
                    if($existingProduct) {
                        if(($cartProduct->quantity + $existingProduct->quantity) > $product->stock) {
                            $existingProduct->quantity = $product->stock;
                            $existingProduct->subtotal = $product->stock * $product->price;
                        }
                        else {
                            $newQuantity = $cartProduct->quantity + $existingProduct->quantity;
                            $existingProduct->quantity = $newQuantity;
                            $existingProduct->subtotal = $newQuantity * $product->price;
                        }
                        $existingProduct->save();
                    }
                    else {
                        if($cartProduct->quantity > $product->stock) {
                            $cartProduct->quantity = $product->stock;
                            $cartProduct->subtotal = $product->stock * $product->price;
                        }
                        ShoppingCartProduct::create([
                            'quantity' => $cartProduct->quantity,
                            'subtotal' => $cartProduct->subtotal,
                            'shoppingcart_id' => $user->shoppingcart->id,
                            'product_variation_id' => $cartProduct->id,
                        ]);
                    }
                }
            }
        }

        return $next($request);
    }
}