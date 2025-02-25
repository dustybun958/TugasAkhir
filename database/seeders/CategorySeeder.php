<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'created_at' => now()
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing and accessories',
                'created_at' => now()
            ],
            [
                'name' => 'Home & Living',
                'description' => 'Home decoration and furniture',
                'created_at' => now()
            ],
            [
                'name' => 'Books',
                'description' => 'Books and educational materials',
                'created_at' => now()
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports equipment and accessories',
                'created_at' => now()
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
