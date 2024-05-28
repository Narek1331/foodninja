<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DesignSetting\DesignSettingParam;

class DesignSettingParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'type' => 'cap',
                'name' => 'Вариант 1',
                'img_path' => '/images/cap/default.jpg'
            ],
            [
                'type' => 'cap',
                'name' => 'Вариант 2',
                'img_path' => '/images/cap/v1.jpg'
            ],
            [
                'type' => 'cap',
                'name' => 'Вариант 3',
                'img_path' => '/images/cap/v2.jpg'
            ],

            [
                'type' => 'mobile_menu',
                'name' => 'Белая',
                'img_path' => '/images/mobile-menu/default.jpg'
            ],
            [
                'type' => 'mobile_menu',
                'name' => 'Черная',
                'img_path' => '/images/mobile-menu/v1.jpg'
            ],

            [
                'type' => 'banner',
                'name' => 'Сторис',
                'img_path' => '/images/banner/stories.jpg'
            ],
            [
                'type' => 'banner',
                'name' => 'Во всю ширину',
                'img_path' => '/images/banner/v1.jpg'
            ],

            [
                'type' => 'category_menu',
                'name' => 'По умолчанию',
                'img_path' => '/images/category-menu/default.jpg'
            ],
            [
                'type' => 'category_menu',
                'name' => 'Без фона',
                'img_path' => '/images/category-menu/v1.jpg'
            ],
            [
                'type' => 'category_menu',
                'name' => 'Основной цвет сайта',
                'img_path' => '/images/category-menu/v2.jpg'
            ],

            [
                'type' => 'product',
                'name' => 'Вариант 1',
                'img_path' => '/images/product/default.jpg'
            ],
            [
                'type' => 'product',
                'name' => 'Вариант 2',
                'img_path' => '/images/product/v1.jpg'
            ],

            [
                'type' => 'footer',
                'name' => 'Черный',
                'img_path' => '/images/footer/default.jpg'
            ],
            [
                'type' => 'footer',
                'name' => 'Белый',
                'img_path' => '/images/footer/v1.jpg'
            ],

            [
                'type' => 'displaying_product_variations',
                'name' => 'Горизонтально',
            ],
            [
                'type' => 'displaying_product_variations',
                'name' => 'Вертикально',
            ],
            [
                'type' => 'displaying_product_variations',
                'name' => 'Выпадающий список',
            ],

            [
                'type' => 'website_font',
                'name' => 'Cera',
            ],
            [
                'type' => 'website_font',
                'name' => 'Manrope',
            ],
            [
                'type' => 'website_font',
                'name' => 'Nunito',
            ],
            [
                'type' => 'website_font',
                'name' => 'Fira Sans',
            ],
            [
                'type' => 'website_font',
                'name' => 'Rubik',
            ],


        ];

        foreach($datas as $data){
            DesignSettingParam::create([
                'type' => $data['type'],
                'name' => $data['name'],
                'img_path' => isset($data['img_path']) ? $data['img_path'] : null
            ]);
        }
    }
}
