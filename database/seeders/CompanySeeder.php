<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Company::insert([
            [
                'default' => 1,
                'name' => 'Dadaşlar Palet',
            ],
            [
                'default' => 0,
                'name' => 'Demir Palet',
            ],
            [
                'default' => 0,
                'name' => 'PCS Palet',
            ]
        ]);
    }
}
