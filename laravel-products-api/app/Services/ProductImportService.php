<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductImportService
{
const API_URL = 'https://dummyjson.com/products';

    public function importProducts(): array
    {
        try {
            $response = Http::get(self::API_URL);
            
            if (!$response->successful()) {
                throw new \Exception("Failed to fetch products from DummyJSON API");
            }

            $data = $response->json();
            
            if (!isset($data['products'])) {
                throw new \Exception("Invalid DummyJSON API response format");
            }

            $importedCount = 0;
            $updatedCount = 0;

            foreach ($data['products'] as $productData) {
                $result = Product::updateOrCreate(
                    ['id' => $productData['id']],
                    [
                        'title' => $productData['title'],
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'thumbnail' => $productData['thumbnail'],
                    ]
                );

                $result->wasRecentlyCreated ? $importedCount++ : $updatedCount++;
            }

            return [
                'success' => true,
                'message' => 'Products imported successfully from DummyJSON',
                'stats' => [
                    'imported' => $importedCount,
                    'updated' => $updatedCount,
                    'total' => count($data['products'])
                ]
            ];

        } catch (\Exception $e) {
            Log::error("DummyJSON import failed: " . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}


