<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Pastikan folder products ada
        if (!Storage::exists('public/products')) {
            Storage::makeDirectory('public/products');
        }

        $products = [
            // Electronics (category_id = 1)
            [
                'category_id' => 1,
                'name' => 'Smartphone X1',
                'description' => '<p>Latest smartphone with advanced features: 6.5" AMOLED display, 128GB storage, 8GB RAM, 5G enabled</p>',
                'price' =>  1000000,
                'stock' => 50,
                'image_path' => $this->downloadAndSaveImage(
                    'https://shopic.mcmcclass.com/42aa1ae14d3f4cb49df40601739647db/20221221/image/922897447523455639/%E4%B8%BB%E5%9B%BE.jpg',
                    'smartphone.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 1,
                'name' => 'Laptop Pro 2025',
                'description' => '<p>Professional laptop with Intel i9, 32GB RAM, 1TB SSD, RTX 4080</p>',
                'price' => 15000000,
                'stock' => 30,
                'image_path' => $this->downloadAndSaveImage(
                    'https://pcmax.id/wp-content/uploads/2025/01/image-26-1024x538.png',
                    'laptop.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 1,
                'name' => 'Wireless Earbuds Pro',
                'description' => '<p>Premium wireless earbuds with active noise cancellation and 24-hour battery life</p>',
                'price' => 800000,
                'stock' => 100,
                'image_path' => $this->downloadAndSaveImage(
                    'https://images-cdn.ubuy.co.id/64027205f13d1111231b129f-apple-airpods-pro-2nd-generation.jpg',
                    'earbuds.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 2,
                'name' => 'Classic Denim Jacket',
                'description' => '<p>Timeless denim jacket made from premium cotton</p>',
                'price' => 450000,
                'stock' => 75,
                'image_path' => $this->downloadAndSaveImage(
                    'https://down-id.img.susercontent.com/file/sg-11134201-7reoy-m2amdu1uzni86d',
                    'denim-jacket.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 2,
                'name' => 'Premium Leather Sneakers',
                'description' => '<p>Handcrafted leather sneakers with comfort insoles</p>',
                'price' => 350000,
                'stock' => 45,
                'image_path' => $this->downloadAndSaveImage(
                    'https://down-id.img.susercontent.com/file/7bbe392e03d4e95fee4991ca19d72d52',
                    'leather-sneakers.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 3,
                'name' => 'Modern Coffee Table',
                'description' => '<p>Minimalist design coffee table with storage compartment</p>',
                'price' => 500000,
                'stock' => 25,
                'image_path' => $this->downloadAndSaveImage(
                    'https://m.media-amazon.com/images/I/A11vNaMYXSL.jpg',
                    'coffee-table.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 3,
                'name' => 'Smart LED Lamp',
                'description' => '<p>WiFi-enabled LED lamp with voice control support</p>',
                'price' => 90000,
                'stock' => 60,
                'image_path' => $this->downloadAndSaveImage(
                    'https://images.tokopedia.net/img/cache/700/VqbcmM/2023/9/2/51e0456f-57c5-4c62-a9cf-67b254761a72.jpg',
                    'smart-led.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 4,
                'name' => 'Web Development Guide 2025',
                'description' => '<p>Comprehensive guide to modern web development practices</p>',
                'price' => 55000,
                'stock' => 100,
                'image_path' => $this->downloadAndSaveImage(
                    'https://m.media-amazon.com/images/I/7127pava55L.jpg',
                    'webdev-book.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 4,
                'name' => 'AI & Machine Learning Basics',
                'description' => '<p>Beginner-friendly guide to artificial intelligence</p>',
                'price' => 70000,
                'stock' => 85,
                'image_path' => $this->downloadAndSaveImage(
                    'https://m.media-amazon.com/images/I/61JMU0J78QL._AC_UF1000,1000_QL80_.jpg',
                    'ai-ml-book.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 5,
                'name' => 'Professional Yoga Mat',
                'description' => '<p>Extra thick eco-friendly yoga mat with carrying strap</p>',
                'price' => 95000,
                'stock' => 120,
                'image_path' => $this->downloadAndSaveImage(
                    'https://149358845.v2.pressablecdn.com/wp-content/uploads/2023/09/Cover-PRO-600x600.png',
                    'yoga-matras.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 5,
                'name' => 'Smart Fitness Watch',
                'description' => '<p>Advanced fitness tracker with heart rate monitoring</p>',
                'price' => 300000,
                'stock' => 40,
                'image_path' => $this->downloadAndSaveImage(
                    'https://images.tokopedia.net/img/cache/700/VqbcmM/2024/12/9/1df47a83-26f7-467e-81f5-27d75b55f433.jpg',
                    'fitness-watch.jpg'
                ),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('products')->insert($products);
    }

    private function downloadAndSaveImage($url, $filename)
    {
        try {
            // Download gambar
            $contents = file_get_contents($url);

            if ($contents === false) {
                return null;
            }

            // Simpan gambar ke storage/app/public/products
            Storage::put('public/products/' . $filename, $contents);

            // Return path yang sesuai dengan asset() di blade
            return $filename; // Tanpa 'products/' di depannya

        } catch (\Exception $e) {
            Log::error('Error downloading image: ' . $e->getMessage());
            return null;
        }
    }
}
