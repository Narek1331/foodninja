<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DisplayLocation;

class DisplayLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            'ПК',
            'Мобайл',
            'Приложение ВК',
            'Приложение ТГ',
            'Приложение iPhone',
            'Приложение Android',
        ];

        foreach ($datas as $data) {
            DisplayLocation::create([
                'name' => $data
            ]);
        }


    }
}
