<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Makanan',
                'description' => 'Berbagai jenis makanan',
                'created_at' => now()
            ],
            [
                'name' => 'Minuman',
                'description' => 'Berbagai jenis minuman',
                'created_at' => now()
            ],
            [
                'name' => 'Snack',
                'description' => 'Berbagai jenis cemilan',
                'created_at' => now()
            ]
        ]);
    }
}
