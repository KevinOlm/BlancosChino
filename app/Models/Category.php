<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category'];

    protected static function booted() {
        static::deleting(function ($category) {
            foreach($category->products as $productCategory) {
                $productCategory->category_id = 1;
                $productCategory->save();
            }
        });
    }

    public function products() {
        return $this->hasMany('App\Models\Product');
    }
}
