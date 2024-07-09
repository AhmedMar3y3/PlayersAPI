<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_id'=> User::all()->random()->id,
            'name' => $this->faker->unique()->sentence,
            'player_num'=> $this->faker->numberBetween(1,99),
            'player_position' => $this->faker->randomElement(['GK','CB','RB','LB','CM','RW','LW','FW']),
            

        ];
    }
}
