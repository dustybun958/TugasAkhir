<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    private $products = [
        'Makanan' => [
            'Nasi Goreng',
            'Mie Goreng',
            'Ayam Bakar',
            'Sate Ayam',
            'Soto Ayam',
            'Bakso',
            'Gado-gado',
            'Rendang',
            'Sop Buntut',
            'Nasi Uduk'
        ],
        'Minuman' => [
            'Es Teh',
            'Es Jeruk',
            'Es Campur',
            'Jus Alpukat',
            'Es Kopi',
            'Smoothie',
            'Milkshake',
            'Es Cincau',
            'Es Dawet',
            'Soda Gembira'
        ],
        'Snack' => [
            'Kentang Goreng',
            'Pisang Goreng',
            'Tempe Mendoan',
            'Tahu Crispy',
            'Cireng',
            'Piscok',
            'Risoles',
            'Lumpia',
            'Bakwan',
            'Martabak Mini'
        ]
    ];

    public function run()
    {
        if (!Storage::exists('public/products')) {
            Storage::makeDirectory('public/products');
        }

        $productData = [];
        $counter = 1;

        foreach ($this->products as $categoryName => $items) {
            $categoryId = DB::table('categories')
                ->where('name', $categoryName)
                ->first()->id;

            foreach ($items as $item) {
                $productData[] = [
                    'category_id' => $categoryId,
                    'name' => $item,
                    'description' => "<p>Deskripsi untuk $item</p>",
                    'price' => rand(5000, 100000),
                    'stock' => rand(10, 200),
                    'image_path' => $this->generateDummyImage("product-$counter.png"),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                $counter++;
            }
        }

        DB::table('products')->insert($productData);
    }

    private function generateDummyImage($filename)
    {
        $image = imagecreatetruecolor(300, 300);
        $bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
        $textColor = imagecolorallocate($image, 50, 50, 50);

        imagefill($image, 0, 0, $bgColor);
        imagestring($image, 5, 100, 140, 'Product Image', $textColor);

        $path = storage_path('app/public/products/' . $filename);
        imagepng($image, $path);
        imagedestroy($image);

        return 'products/' . $filename;
    }
}
