<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    private $customerNames = [
        'John Doe',
        'Jane Smith',
        'Ahmad',
        'Siti',
        'Michael',
        'Sarah',
        'David',
        'Lisa',
        'Robert',
        'Emma'
    ];

    public function run()
    {
        $transactions = [];
        $productIds = DB::table('products')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $productId = $productIds[array_rand($productIds)];
            $product = DB::table('products')->find($productId);
            $quantity = rand(1, 10);

            $transactions[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'total_price' => $product->price * $quantity,
                'transaction_date' => now()->subDays(rand(0, 30))->addHours(rand(0, 23)),
                'customer_name' => $this->customerNames[array_rand($this->customerNames)],
                'customer_phone' => '08' . rand(1000000000, 9999999999)
            ];
        }

        DB::table('transactions')->insert($transactions);
    }
}
