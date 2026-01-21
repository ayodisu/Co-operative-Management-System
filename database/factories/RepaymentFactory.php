<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Repayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepaymentFactory extends Factory
{
    protected $model = Repayment::class;

    public function definition(): array
    {
        return [
            'loan_id' => Loan::factory(),
            'amount' => fake()->randomElement([5000, 10000, 15000, 20000]),
            'payment_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'remarks' => fake()->optional()->sentence(),
        ];
    }
}
