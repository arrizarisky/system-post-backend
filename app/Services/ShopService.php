<?php

namespace App\Services;

use App\Repositories\ShopRepository;
use Illuminate\Http\UploadedFile;

class ShopService
{
    private ShopRepository $shopRepository;

    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    public function onboardShop(int $userId, array $data)
    {
        $shop = $this->shopRepository->findByUserId($userId);

        if ($shop) {
            // Update existing shop
            $logoPath = $this->uploadPhoto($data['logo'] ?? null);
            $updateData = ['is_onboarded' => true];
            if ($logoPath) $updateData['logo'] = $logoPath;
            if (isset($data['name'])) $updateData['name'] = $data['name'];
            return $this->shopRepository->update($shop->id, $updateData);
        } else {
            // Create new shop
            $logoPath = $this->uploadPhoto($data['logo'] ?? null);
            $createData = [
                'user_id' => $userId,
                'name' => $data['name'],
                'logo' => $logoPath,
                'is_onboarded' => true,
            ];
            return $this->shopRepository->create($createData);
        }
    }

    public function uploadPhoto(UploadedFile $photo)
    {
        return $photo->store('shop', 'public');
    }
}
