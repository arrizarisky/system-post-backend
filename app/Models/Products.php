<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    protected $fillable = ['shop_id', 'category_id', 'name', 'barcode', 'photo'];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariants::class);
    }

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return url(Storage::url($value));
    }
}
