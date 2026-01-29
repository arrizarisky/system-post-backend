<?php

namespace App\Repositories;

use App\Models\Shops;

class ShopRepository
{
    public function findByUserId(int $userId)
    {
        return Shops::where('user_id', $userId)->first();
    }

    public function create(array $data)
    {
        return Shops::create($data);
    }

    public function update(int $shopId, array $data)
    {
        $shop = Shops::findOrFail($shopId);
        $shop->update($data);
        return $shop;
    }
}
