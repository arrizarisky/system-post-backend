<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Http\Resources\ShopResources;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    private ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function store(ShopRequest $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $shop = $this->shopService->onboardShop($userId, $request->validated());

        return response()->json([
            'message' => 'Toko berhasil di buat',
            'data' => new ShopResources($shop)
        ], 201);
    }
}
