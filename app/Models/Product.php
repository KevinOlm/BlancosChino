<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function booted() {
        static::deleting(function ($product) {
            foreach($product->images as $image) {
                $image->delete();
            }

            foreach($product->reviews as $review) {
                $review->delete();
            }
        });
    }

    protected $fillable = ['groupName', 'category_id'];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

    public function reviews() {
        return $this->hasMany('App\Models\Review');
    }

    public function productVariations() {
        return $this->hasMany('App\Models\ProductVariation');
    }
}
