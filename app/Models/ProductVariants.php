<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    protected $fillable = ['product_id', 'size', 'stock', 'color', 'price'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
