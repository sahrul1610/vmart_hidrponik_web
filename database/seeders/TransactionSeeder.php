<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ke tabel 'transactions'
        DB::table('transactions')->insert([
            'users_id' => 2,
            'address' => 'Alamat pengiriman 1',
            'total_price' => 250.00,
            'shipping_price' => 10.00,
            'status' => 'pending',
            'payment' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Menambahkan data ke tabel 'transaction_items' untuk transaksi pertama
        DB::table('transaction_items')->insert([
            'users_id' => 2,
            'products_id' => 1,
            'transactions_id' => 1,
            'quantity' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
