<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    protected $fillable = ['keeper_id', 'name', 'photo', 'is_boarding'];
    protected $casts = ['is_boarding' => 'boolean'];

    public function keeper()
    {
        return $this->belongsTo(User::class, 'keeper_id');
    }

    public function product()
    {
        return $this->hasMany(Products::class);
    }

    public function coupon()
    {
        return $this->hasMany(Coupons::class);
    }
}
