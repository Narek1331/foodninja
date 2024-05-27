<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maintenance\MaintenanceSettingMode;

class MaintenanceSettingModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modes = [
            'Отключить полностью',
            'Оставить возможность предзаказа',
            'Часы высокой нагрузки'
        ];

        foreach($modes as $mode){
            MaintenanceSettingMode::create([
                'name' =>$mode
            ]);
        }
    }
}
