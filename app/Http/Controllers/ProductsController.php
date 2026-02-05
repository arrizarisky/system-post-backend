<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResources;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $fields = ['id', 'category_id', 'name', 'barcode', 'photo'];
        $products = $this->productService->getAll($fields);
        return response()->json(ProductResources::collection($products));
    }

    public function show($id)
    {
        $fields = ['id', 'category_id', 'name', 'barcode', 'photo'];
        $product = $this->productService->getById($id, $fields);
        return response()->json(['data' => $product], 200);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = $this->productService->create($data);
        return response()->json(new ProductResources($product), 201);
    }

    public function update(ProductRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $product = $this->productService->update($id, $data);
            return response()->json(new ProductResources($product));
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'message' => 'Product not found.'
                ],
                404
            );
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->productService->delete($id);
            return response()->json(
                [
                    'message' => 'Product deleted successfully.'
                ]
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'message' => 'Product not found.'
                ],
                404
            );
        }
    }
}
