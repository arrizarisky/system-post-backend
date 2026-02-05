<?php

namespace App\Repositories;

use App\Models\Products;

class ProductRepository
{
    public function getAll(array $fields)
    {
        return Products::query()
            ->select($fields)
            ->with('category')
            ->latest()
            ->paginate(50);
    }

    public function getById(int $id, array $fields)
    {
        return Products::query()
            ->select($fields)
            ->with('category', 'variants')
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Products::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = Products::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        $product = Products::findOrFail($id);
        return $product->delete();
    }
}
