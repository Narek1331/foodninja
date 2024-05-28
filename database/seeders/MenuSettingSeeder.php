<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuSetting\MenuSetting;

class MenuSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            'Верхнее меню',
            'Нижнее меню'
        ];

        foreach($menus as $menu){
            MenuSetting::create([
                'name' =>$menu
            ]);
        }
    }
}
