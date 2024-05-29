<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            'Понедельник', // Monday
            'Вторник', // Tuesday
            'Среда', // Wednesday
            'Четверг', // Thursday
            'Пятница', // Friday
            'Суббота', // Saturday
            'Воскресенье' // Sunday
        ];

        foreach($days as $day){
            Day::create([
                'name' => $day
            ]);
        }
    }
}
