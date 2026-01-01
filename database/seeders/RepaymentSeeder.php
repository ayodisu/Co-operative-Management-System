<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Repayment;

class RepaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan = Loan::latest()->first();

        if ($loan) {
            $dates = [
                now()->subMonths(2),
                now()->subMonth(),
                now()->subWeeks(2)
            ];

            foreach ($dates as $date) {
                Repayment::create([
                    'loan_id' => $loan->id,
                    'amount' => rand(10000, 50000),
                    'payment_method' => 'Bank Transfer',
                    'payment_date' => $date,
                    'remarks' => 'Monthly installment - ' . $date->format('M Y'),
                ]);
            }

            $this->command->info('Dummy repayments created for Loan ID: ' . $loan->id);
        } else {
            $this->command->error('No loans found to seed payments for.');
        }
    }
}
