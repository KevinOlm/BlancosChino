<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted() {
        static::created(function($review) {
            $product = Product::find($review->product_id);
            
            $reviewNumber = $product->calificationNumber;
            $productCalification = $product->calification;

            $product->calificationNumber = $reviewNumber + 1;
            $product->calification = (($productCalification * $reviewNumber) + $review->review) / ($reviewNumber + 1);
            $product->save();
        });

        static::updated(function($review) {
            $product = Product::find($review->product_id);
            $reviews = Review::where('product_id', '=', $review->product_id)->get();
            
            $newCalification = 0;
            foreach($reviews as $userReview) {
                $newCalification += $userReview->review;
            }
            $newCalification = $newCalification/count($reviews);

            $product->calification = $newCalification;
            $product->save();
        });

        static::deleted(function($review) {
            $product = Product::find($review->product_id);

            $reviewNumber = $product->calificationNumber;
            $productCalification = $product->calification;

            if($reviewNumber > 1) {
                $product->calification = (($productCalification * $reviewNumber) - $review->review) / ($reviewNumber - 1);
                $product->calificationNumber = $reviewNumber - 1;
            }
            else {
                $product->calification = 5;
                $product->calificationNumber = 0;
            }
            $product->save();
        });
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function user() {
        return $this->belongsTo(('App\Models\User'));
    }
}
