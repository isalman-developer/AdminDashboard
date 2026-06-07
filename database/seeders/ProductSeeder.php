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
            // Gaming Laptops
            [
                'category_id'     => $cats['gaming-laptops'] ?? null,
                'name'            => 'ASUS ROG Strix G16',
                'sku'             => 'GL-001',
                'description'     => 'Intel Core i9-14900HX, RTX 4070, 16GB RAM, 1TB SSD, 16" 240Hz display.',
                'price'           => 1499.99,
                'stock_quantity'  => 35,
                'warranty_months' => 24,
                'discount_percent'=> 5,
                'is_active'       => true,
            ],
            [
                'category_id'     => $cats['gaming-laptops'] ?? null,
                'name'            => 'Acer Predator Helios 16',
                'sku'             => 'GL-002',
                'description'     => 'Intel Core i7-14700HX, RTX 4060, 16GB RAM, 1TB SSD, QHD 165Hz display.',
                'price'           => 1299.99,
                'stock_quantity'  => 42,
                'warranty_months' => 24,
                'discount_percent'=> 3,
                'is_active'       => true,
            ],
            // Business Laptops
            [
                'category_id'     => $cats['business-laptops'] ?? null,
                'name'            => 'Dell Latitude 5540',
                'sku'             => 'BL-001',
                'description'     => 'Intel Core i7-1355U, 16GB RAM, 512GB SSD, 15.6" FHD, fingerprint reader.',
                'price'           => 899.99,
                'stock_quantity'  => 80,
                'warranty_months' => 36,
                'discount_percent'=> 10,
                'is_active'       => true,
            ],
            [
                'category_id'     => $cats['business-laptops'] ?? null,
                'name'            => 'HP EliteBook 840 G10',
                'sku'             => 'BL-002',
                'description'     => 'Intel Core i7-1365U, 32GB RAM, 1TB SSD, 14" FHD, enterprise security suite.',
                'price'           => 1049.99,
                'stock_quantity'  => 55,
                'warranty_months' => 36,
                'discount_percent'=> 8,
                'is_active'       => true,
            ],
            // Ultrabooks
            [
                'category_id'     => $cats['ultrabooks'] ?? null,
                'name'            => 'Apple MacBook Air 15" M4',
                'sku'             => 'UL-001',
                'description'     => 'Apple M4 chip, 16GB RAM, 512GB SSD, 15.3" Liquid Retina, all-day battery.',
                'price'           => 1299.99,
                'stock_quantity'  => 60,
                'warranty_months' => 12,
                'discount_percent'=> 0,
                'is_active'       => true,
            ],
            [
                'category_id'     => $cats['ultrabooks'] ?? null,
                'name'            => 'Lenovo Yoga Slim 7i',
                'sku'             => 'UL-002',
                'description'     => 'Intel Core Ultra 7 155U, 16GB RAM, 1TB SSD, 14" OLED WQXGA+, 1.2kg.',
                'price'           => 949.99,
                'stock_quantity'  => 45,
                'warranty_months' => 24,
                'discount_percent'=> 7,
                'is_active'       => true,
            ],
            // Workstation Laptops
            [
                'category_id'     => $cats['workstation-laptops'] ?? null,
                'name'            => 'Dell Precision 5690',
                'sku'             => 'WL-001',
                'description'     => 'Intel Core Ultra 9 185H, RTX 3000 Ada, 64GB RAM, 2TB SSD, 16" 4K touch.',
                'price'           => 2199.99,
                'stock_quantity'  => 15,
                'warranty_months' => 36,
                'discount_percent'=> 5,
                'is_active'       => true,
            ],
            [
                'category_id'     => $cats['workstation-laptops'] ?? null,
                'name'            => 'Lenovo ThinkPad P16s Gen 3',
                'sku'             => 'WL-002',
                'description'     => 'AMD Ryzen 9 PRO 7940HS, RTX A500, 32GB RAM, 1TB SSD, 16" WUXGA IPS.',
                'price'           => 1799.99,
                'stock_quantity'  => 20,
                'warranty_months' => 36,
                'discount_percent'=> 4,
                'is_active'       => true,
            ],
            // 2-in-1 Laptops
            [
                'category_id'     => $cats['2-in-1-laptops'] ?? null,
                'name'            => 'Microsoft Surface Laptop 6',
                'sku'             => '2I-001',
                'description'     => 'Intel Core Ultra 7 165H, 16GB RAM, 1TB SSD, 13.5" PixelSense touch, Surface Pen.',
                'price'           => 1099.99,
                'stock_quantity'  => 38,
                'warranty_months' => 12,
                'discount_percent'=> 6,
                'is_active'       => true,
            ],
            [
                'category_id'     => $cats['2-in-1-laptops'] ?? null,
                'name'            => 'HP Envy x360 16',
                'sku'             => '2I-002',
                'description'     => 'AMD Ryzen 7 8840HS, 16GB RAM, 1TB SSD, 16" FHD+ touch, 360-degree hinge.',
                'price'           => 849.99,
                'stock_quantity'  => 50,
                'warranty_months' => 12,
                'discount_percent'=> 9,
                'is_active'       => true,
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
