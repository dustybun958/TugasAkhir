<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Using Indonesian locale

        // Get all product IDs from the products table
        $productIds = DB::table('products')->pluck('id')->toArray();

        // Generate 50 transactions
        $transactions = [];

        for ($i = 0; $i < 50; $i++) {
            // Get random product ID
            $productId = $faker->randomElement($productIds);

            // Get product price for calculation
            $product = DB::table('products')->where('id', $productId)->first();

            // Random quantity between 1 and 10
            $quantity = $faker->numberBetween(1, 10);

            // Calculate total price
            $totalPrice = $quantity * $product->price;

            // Generate random date within the last 30 days
            $transactionDate = Carbon::now()->subDays($faker->numberBetween(0, 30));

            $transactions[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'transaction_date' => $transactionDate,
                'customer_name' => $faker->name,
                'customer_phone' => $faker->phoneNumber
            ];
        }

        // Sort transactions by date
        usort($transactions, function ($a, $b) {
            return strtotime($a['transaction_date']) - strtotime($b['transaction_date']);
        });

        // Insert all transactions
        DB::table('transactions')->insert($transactions);
    }
}
