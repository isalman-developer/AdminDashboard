<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cats = Category::pluck('id', 'slug');

        $products = [
            // Health & Wellness
            [
                'category_id'    => $cats['health-wellness'] ?? null,
                'name'           => 'Multivitamin Complex',
                'sku'            => 'MV-001',
                'description'    => 'Daily multivitamin supplement supporting immunity and energy.',
                'price'          => 49.99,
                'bv'             => 5,
                'pv'             => 5,
                'stock_quantity' => 200,
                'is_active'      => true,
            ],
            [
                'category_id'    => $cats['health-wellness'] ?? null,
                'name'           => 'Omega-3 Fish Oil',
                'sku'            => 'MV-002',
                'description'    => 'High-strength omega-3 capsules for heart and brain health.',
                'price'          => 34.99,
                'bv'             => 3,
                'pv'             => 3,
                'stock_quantity' => 150,
                'is_active'      => true,
            ],
            // Beauty & Personal Care
            [
                'category_id'    => $cats['beauty-personal-care'] ?? null,
                'name'           => 'Vitamin C Serum',
                'sku'            => 'BC-001',
                'description'    => 'Brightening serum with 20% Vitamin C for radiant skin.',
                'price'          => 59.99,
                'bv'             => 6,
                'pv'             => 6,
                'stock_quantity' => 120,
                'is_active'      => true,
            ],
            [
                'category_id'    => $cats['beauty-personal-care'] ?? null,
                'name'           => 'Hydrating Face Cream',
                'sku'            => 'BC-002',
                'description'    => 'Deeply moisturising face cream with hyaluronic acid.',
                'price'          => 44.99,
                'bv'             => 4,
                'pv'             => 4,
                'stock_quantity' => 180,
                'is_active'      => true,
            ],
            // Home & Lifestyle
            [
                'category_id'    => $cats['home-lifestyle'] ?? null,
                'name'           => 'Essential Oil Diffuser',
                'sku'            => 'HL-001',
                'description'    => 'Ultrasonic aroma diffuser with colour-changing LED mood light.',
                'price'          => 29.99,
                'bv'             => 3,
                'pv'             => 3,
                'stock_quantity' => 90,
                'is_active'      => true,
            ],
            [
                'category_id'    => $cats['home-lifestyle'] ?? null,
                'name'           => 'Organic Bamboo Towel Set',
                'sku'            => 'HL-002',
                'description'    => 'Set of 4 ultra-soft organic bamboo towels in neutral tones.',
                'price'          => 39.99,
                'bv'             => 4,
                'pv'             => 4,
                'stock_quantity' => 75,
                'is_active'      => true,
            ],
            // Technology & Gadgets
            [
                'category_id'    => $cats['technology-gadgets'] ?? null,
                'name'           => 'Wireless Charging Pad',
                'sku'            => 'TG-001',
                'description'    => '15W fast wireless charger compatible with all Qi-enabled devices.',
                'price'          => 24.99,
                'bv'             => 2,
                'pv'             => 2,
                'stock_quantity' => 300,
                'is_active'      => true,
            ],
            [
                'category_id'    => $cats['technology-gadgets'] ?? null,
                'name'           => 'Fitness Smart Band',
                'sku'            => 'TG-002',
                'description'    => 'Heart-rate, sleep and activity tracker with 7-day battery life.',
                'price'          => 69.99,
                'bv'             => 7,
                'pv'             => 7,
                'stock_quantity' => 60,
                'is_active'      => true,
            ],
        ];

        foreach ($products as $data) {
            $data['slug'] = Str::slug($data['name']);
            Product::updateOrCreate(
                ['sku' => $data['sku']],
                $data
            );
        }
    }
}
