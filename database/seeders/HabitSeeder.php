<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {

            $habits = Habit::factory()->count(10)->create(['user_id' => $user->id]);

            $habits->each(function (Habit $habit): void {
                HabitLog::factory()->count(random_int(10, 50))->create(['habit_id' => $habit->id]);
            });
            
        });
    }
}
