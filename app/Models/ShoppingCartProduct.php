<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    protected $guarded = [];

    use HasFactory;

    protected static function booted() {
        static::created(function($shoppingCartProduct) {
            $shoppingCart = $shoppingCartProduct->shoppingcart;
            $shoppingCart->total += $shoppingCartProduct->subtotal;
            $shoppingCart->save();
        });

        static::updated(function($shoppingCartProduct) {
            $shoppingCart = $shoppingCartProduct->shoppingcart;
            $newTotal = 0;
            foreach ($shoppingCart->shoppingcartProducts as $cartProduct) {
                if ($shoppingCartProduct->id === $cartProduct->id) $newTotal += $shoppingCartProduct->subtotal;
                else $newTotal += $cartProduct->subtotal;
            }
            $shoppingCart->total = $newTotal;
            $shoppingCart->save();
        });

        static::deleted(function($shoppingCartProduct) {
            $shoppingCart = $shoppingCartProduct->shoppingcart;
            $shoppingCart->total -= $shoppingCartProduct->subtotal;
            $shoppingCart->save();
        });
    }

    public function shoppingcart() {
        return $this->belongsTo('App\Models\Shoppingcart');
    }

    public function product() {
        return $this->belongsTo('App\Models\ProductVariation', 'product_variation_id');
    }
}
