<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studio>
 */
class StudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'owner_id' => fake()->randomElement(User::where('user_type', UserTypeEnum::STUDIO_OWNER)->pluck('id')->toArray()),
            'name' => fake()->streetName(),
            'max_day_reservations' => random_int(5, 20),
        ];
    }
}
