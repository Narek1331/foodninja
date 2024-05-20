<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DisplayLocation;
use App\Models\Story;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = DisplayLocation::get();

        foreach ($datas as $data) {
            Story::create([
                'display_location_id' => $data->id
            ]);
        }
    }
}
