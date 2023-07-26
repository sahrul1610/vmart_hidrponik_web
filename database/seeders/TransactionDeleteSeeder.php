<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionDeleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ke tabel 'transactions'
        DB::table('transactions')->delete();

        // Menambahkan data ke tabel 'transaction_items' untuk transaksi pertama
        DB::table('transaction_items')->delete();




        // Tambahkan data lain sesuai kebutuhan
    }
}
