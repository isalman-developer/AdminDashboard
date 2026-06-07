<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name'        => 'Apple',
                'description' => 'Premium consumer electronics and software, including MacBook and iPad.',
            ],
            [
                'name'        => 'Dell',
                'description' => 'Wide range of laptops, desktops, and peripherals for home and business.',
            ],
            [
                'name'        => 'HP',
                'description' => 'Computing solutions from consumer laptops to enterprise workstations.',
            ],
            [
                'name'        => 'Lenovo',
                'description' => 'Business and consumer laptops, including ThinkPad and Yoga lines.',
            ],
            [
                'name'        => 'ASUS',
                'description' => 'High-performance laptops, gaming rigs, and innovative 2-in-1s.',
            ],
            [
                'name'        => 'Acer',
                'description' => 'Budget-friendly laptops, Chromebooks, and gaming Predator series.',
            ],
            [
                'name'        => 'Microsoft',
                'description' => 'Surface family of laptops and hybrid 2-in-1 devices.',
            ],
            [
                'name'        => 'Samsung',
                'description' => 'Premium ultrabooks and Galaxy book series with AMOLED displays.',
            ],
        ];

        foreach ($brands as $data) {
            Brand::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
