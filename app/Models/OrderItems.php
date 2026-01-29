<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = ['order_id', 'product_variant_id', 'quantity', 'unit_price'];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariants::class, 'product_variant_id');
    }
}
