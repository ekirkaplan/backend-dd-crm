<?php

namespace Database\Seeders;

use App\Models\PaymentTransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentTransactionType::insert([
            [
                'name' => 'Sözleşme Hakedişine Mahsuben'
            ],
            [
                'name' => 'Avams Ödeme'
            ],
            [
                'name' => 'Diğer Ödemeler'
            ],
        ]);
    }
}
