<?php

namespace Database\Factories;

use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberProfile>
 */
class MemberProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'occupation' => fake()->jobTitle(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'date_of_appointment' => fake()->date(),
            'grade_level' => fake()->randomElement(['Level 8', 'Level 9', 'Level 10']),
            'department' => fake()->word(),
            'retirement_year' => fake()->year('+20 years'),
            'monthly_contribution' => fake()->numberBetween(5000, 50000),
            'total_contributions' => fake()->numberBetween(100000, 1000000),
            'current_loan_balance' => 0,
        ];
    }
}
