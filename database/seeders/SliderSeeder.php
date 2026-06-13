<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Services\MediaService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;


class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title'    => 'Latest Smartphones',
                'subtitle' => 'Discover the newest arrivals',
                'status'   => true,
                'image'    => 'client/images/banner/mg-home2-banner2.jpg',
            ],
            [
                'title'    => 'Top Deals This Week',
                'subtitle' => 'Save big on premium devices',
                'status'   => true,
                'image'    => 'client/images/banner/mg-home2-banner.jpg',
            ],
            [
                'title'    => 'New Season Collection',
                'subtitle' => 'Explore our curated picks',
                'status'   => true,
                'image'    => 'client/images/banner/mg-banner.jpg',
            ],
            [
                'title'    => 'Premium Tech',
                'subtitle' => 'Performance meets style',
                'status'   => true,
                'image'    => 'client/images/banner/home3-banner.jpg',
            ],
        ];


        foreach ($sliders as $data) {

            $slider = Slider::updateOrCreate(
                ['title' => $data['title']],
                [
                    'subtitle' => $data['subtitle'],
                    'status'   => $data['status'],
                ]
            );

            $imagePath = public_path($data['image']);

            if (! file_exists($imagePath)) {
                continue;
            }

            $file = new UploadedFile(
                $imagePath,
                basename($imagePath),
                mime_content_type($imagePath),
                null,
                true
            );

            app(MediaService::class)->upload(
                $file,
                'sliders',
                $slider,
                'image'
            );
        }
    }
}
