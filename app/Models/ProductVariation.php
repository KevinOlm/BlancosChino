<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted() {
        static::updated(function ($productVariation) {
            $cartProducts = ShoppingCartProduct::where('product_variation_id', '=', $productVariation->id)->get();
            if($productVariation->stock < 1) {
                foreach($cartProducts as $cartProduct) $cartProduct->delete();
            }
            else {
                foreach($cartProducts as $cartProduct) {
                    if($cartProduct->quantity > $productVariation->stock) $cartProduct->quantity = $productVariation->stock;
                    $cartProduct->subtotal = $cartProduct->quantity * $productVariation->price;
                    $cartProduct->save();
                }
            }
        });

        static::deleting(function ($productVariation) {
            $cartProducts = ShoppingCartProduct::where('product_variation_id', '=', $productVariation->id)->get();
            foreach($cartProducts as $cartProduct) {
                $shoppingcart = $cartProduct->shoppingCart;
                $shoppingcart->total -= $cartProduct->subtotal;
                $shoppingcart->save();
            }
        });

        static::deleted(function ($productVariation) {
            if(count($productVariation->product->productVariations) < 1) $productVariation->product->delete();
        });
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function size() {
        return $this->belongsTo('App\Models\Size');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function shoppingcartProduct() {
        return $this->hasOne('App\Models\ShoppingCartProduct');
    }
}
