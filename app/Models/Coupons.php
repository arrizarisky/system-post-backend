<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'max_discount_amount',
        'valid_from',
        'valid_until',
        'min_spend',
        'user_limit',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
        'min_spend' => 'integer',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
    ];

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function scopeActiveNow($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
            ->where('valid_from', '<=', $now)
            ->where('valid_until', '>=', $now)
            ->whereColumn('used_count', '<', 'usage_limit');
    }

    public function isValid(): bool
    {
        $now = Carbon::now();
        return $this->is_active &&
            $this->valid_from <= $now &&
            $this->valid_until >= $now &&
            $this->used_count < $this->usage_limit;
    }
}
