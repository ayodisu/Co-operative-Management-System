<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => fake()->randomElement([50000, 100000, 150000, 200000]),
            'duration_months' => fake()->randomElement([3, 6, 12]),
            'purpose' => fake()->sentence(),
            'status' => 'pending',
            'admin_remark' => null,
        ];
    }

    public function approved(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'approved',
            'admin_remark' => 'Approved by admin',
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rejected',
            'admin_remark' => 'Rejected due to insufficient equity',
        ]);
    }
}
