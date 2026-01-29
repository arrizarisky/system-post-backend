<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['shop_id', 'keeper_id', 'customer_id', 'total_amount', 'discount_amount', 'coupon_id', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupons::class);
    }
}
