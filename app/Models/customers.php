<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function order()
    {
        return $this->hasMany(Orders::class);
    }
}
