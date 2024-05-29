<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount\DiscountType;

class DiscountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Скидка в процентах',
            'Скидка в рублях',
        ];

        foreach($types as $type){
            DiscountType::create([
                'name' => $type
            ]);
        }
    }
}
