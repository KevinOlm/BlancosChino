<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function purchaseOrder() {
        return $this->belongsTo('App\Models\PurchaseOrder');
    }
}
