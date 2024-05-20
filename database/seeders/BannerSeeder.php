<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DisplayLocation;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = DisplayLocation::get();

        foreach ($datas as $data) {
            Banner::create([
                'display_location_id' => $data->id
            ]);
        }
    }
}
