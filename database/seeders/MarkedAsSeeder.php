<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkedAsSeeder extends Seeder
{
    public function run(): void
    {
        $markers = [
            ['id' => 1, 'name' => 'Normal'],
            ['id' => 2, 'name' => 'Featured'],
            ['id' => 3, 'name' => 'Best Seller'],
            ['id' => 4, 'name' => 'Sale'],
            ['id' => 5, 'name' => 'Top Rated'],
            ['id' => 6, 'name' => 'Top Deal'],
        ];

        foreach ($markers as $marker) {
            DB::table('marked_as')->updateOrInsert(
                ['id' => $marker['id']],
                ['name' => $marker['name'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
