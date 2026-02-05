<?php

namespace App\Repositories;

use App\Models\Categories;
use Illuminate\Validation\Rules\Can;

class CategoryRepository
{
    public function getAll(array $fields)
    {
        return Categories::query()
            ->select($fields)
            ->latest()
            ->paginate(10);
    }

    public function getById(int $id, array $fields)
    {
        return Categories::query()
            ->select($fields)
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Categories::query()->create($data);
    }

    public function update(int $id, array $data)
    {
        $category = Categories::query()->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = Categories::query()->findOrFail($id);

        $category->delete();
    }
}
