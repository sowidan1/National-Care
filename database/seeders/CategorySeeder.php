<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\Ulid;

class CategorySeeder extends Seeder
{
    public static array $categoryIds = [];

    public function run(): void
    {
        $categories = [
            [
                'id'          => Ulid::generate(),
                'name'        => 'Pain Relief',
                'description' => 'Pain Relief',
                'image_url'   => 'https://m.media-amazon.com/images/I/61X8q2Z2Z2L._AC_SL1000_.jpg'
            ],
            [
                'id'          => Ulid::generate(),
                'name'        => 'First Aid',
                'description' => 'First Aid',
                'image_url'   => 'https://m.media-amazon.com/images/I/81q2Z2Z2Z2L._AC_SL1500_.jpg'
            ],
            [
                'id'          => Ulid::generate(),
                'name'        => 'Cold & Flu',
                'description' => 'Cold & Flu',
                'image_url'   => 'https://m.media-amazon.com/images/I/61B2Z2Z2Z2L._AC_SL1000_.jpg'
            ],
            [
                'id'          => Ulid::generate(),
                'name'        => 'Vitamins',
                'description' => 'Vitamins',
                'image_url'   => 'https://m.media-amazon.com/images/I/71V2Zk2f8JL._AC_SL1500_.jpg'
            ],
            [
                'id'          => Ulid::generate(),
                'name'        => 'Medical Devices',
                'description' => 'Medical Devices',
                'image_url'   => 'https://m.media-amazon.com/images/I/71qB6yHo5uL._AC_SL1500_.jpg'
            ],
        ];

        // Store category IDs for use in ProductSeeder
        foreach ($categories as $index => $category) {
            self::$categoryIds[$category['name']] = $category['id'];
        }

        DB::table('categories')->insert($categories);
    }
}