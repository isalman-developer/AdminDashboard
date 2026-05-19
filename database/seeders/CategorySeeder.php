<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Health & Wellness',
                'slug'        => 'health-wellness',
                'description' => 'Nutritional supplements, vitamins, and health products.',
            ],
            [
                'name'        => 'Beauty & Personal Care',
                'slug'        => 'beauty-personal-care',
                'description' => 'Skincare, haircare, and personal grooming products.',
            ],
            [
                'name'        => 'Home & Lifestyle',
                'slug'        => 'home-lifestyle',
                'description' => 'Home essentials, cleaning supplies, and lifestyle products.',
            ],
            [
                'name'        => 'Technology & Gadgets',
                'slug'        => 'technology-gadgets',
                'description' => 'Consumer electronics, accessories, and smart devices.',
            ],
            [
                'name'        => 'Finance & Business',
                'slug'        => 'finance-business',
                'description' => 'Business tools, financial products, and training materials.',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
