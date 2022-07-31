<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    protected $fillable = ['user_id'];

    use HasFactory;

    public function shoppingcartProducts() {
        return $this->hasMany('App\Models\ShoppingCartProduct');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
