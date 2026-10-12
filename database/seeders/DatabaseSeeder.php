<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = [
            'Elektronik',
            'Aksesoris',
            'Pakaian',
            'Peralatan Rumah',
            'Olahraga',
        ];

        foreach ($categoryNames as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['description' => 'Kategori produk ' . $name]
            );
        }

        $categoryIds = Category::whereIn('name', $categoryNames)
            ->pluck('id')
            ->all();

        $existingProducts = Product::count();
        $productsToCreate = max(0, 50 - $existingProducts);

        if ($productsToCreate > 0) {
            Product::factory()
                ->count($productsToCreate)
                ->state(function () use ($categoryIds) {
                    return [
                        'category_id' => fake()->randomElement($categoryIds),
                    ];
                })
                ->create();
        }
    }
}
