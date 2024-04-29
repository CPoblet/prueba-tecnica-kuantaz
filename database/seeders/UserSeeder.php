<?php

namespace Database\Seeders;

use App\Models\Benefit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create();
        $benefits = Benefit::all();

        for ($i = 0; $i < 10000; $i++) {
            $user->benefits()->attach(
                $benefits->random()->id,
                [
                    'amount' => fake()->numberBetween(0, 200000),
                    'created_at' => fake()->dateTime(),
                ]
            );
        }
    }
}
