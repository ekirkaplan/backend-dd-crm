<?php

namespace Database\Seeders;

use App\Models\CostType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostType::insert([
            [
                'name' => "Kesim Ekibi",
            ],
            [
                'name' => "Ekipman Satın Alma",
            ],
            [
                'name' => "Ekipman Kiralama",
            ],
            [
                'name' => "Sevkiyat - Lojistik",
            ],
            [
                'name' => "Yükleme - İndirme",
            ],
            [
                'name' => "Hizmet Alımı",
            ],
            [
                'name' => "Diğer Giderler",
            ],
        ]);
    }
}
