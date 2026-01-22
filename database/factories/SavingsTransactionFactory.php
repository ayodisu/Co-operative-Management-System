<?php

namespace Database\Factories;

use App\Models\SavingsTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SavingsTransaction>
 */
class SavingsTransactionFactory extends Factory
{
    protected $model = SavingsTransaction::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['deposit', 'withdrawal', 'interest']),
            'amount' => fake()->numberBetween(1000, 50000),
            'balance_after' => 0, // Should be calculated in logic/tests
            'description' => fake()->sentence(),
        ];
    }
}
