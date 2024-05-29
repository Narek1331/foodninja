<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Delivery\DeliveryType;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Самовывоз и доставка',
            'Доставка',
            'Самовывоз',
        ];

        foreach($types as $type){
            DeliveryType::create([
                'name' => $type
            ]);
        }
    }
}
