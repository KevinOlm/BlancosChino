<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size'];

    protected static function booted() {
        static::deleting(function ($size) {
            foreach($size->productVariations as $productSize) {
                $productSize->size_id = 1;
                $productSize->save();
            }
        });
    }

    public function productVariations() {
        return $this->hasMany('App\Models\ProductVariation');
    }
}
