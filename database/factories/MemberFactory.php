<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'member_type_id' => mt_rand(1, 3),
            'phone' => $this->faker->numerify('0822-####-####'),
            'email' => $this->faker->unique()->safeEmail(),
            'join_date' => Carbon::now()->toDateString(),
            'expired_date' => Carbon::now()->addDays(30)->toDateString(),
        ];
    }
}
