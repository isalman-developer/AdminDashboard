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
                'name'        => 'Gaming Laptops',
                'slug'        => 'gaming-laptops',
                'description' => 'High-performance gaming laptops with dedicated graphics.',
            ],
            [
                'name'        => 'Business Laptops',
                'slug'        => 'business-laptops',
                'description' => 'Reliable business laptops built for productivity and security.',
            ],
            [
                'name'        => 'Ultrabooks',
                'slug'        => 'ultrabooks',
                'description' => 'Thin-and-light laptops combining portability with performance.',
            ],
            [
                'name'        => 'Workstation Laptops',
                'slug'        => 'workstation-laptops',
                'description' => 'Professional-grade workstations for engineering and creative workloads.',
            ],
            [
                'name'        => '2-in-1 Laptops',
                'slug'        => '2-in-1-laptops',
                'description' => 'Versatile convertible and detachable laptop-tablet hybrids.',
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
