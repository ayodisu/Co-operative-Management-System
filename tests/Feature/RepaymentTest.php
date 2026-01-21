<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Loan;
use App\Models\Repayment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_record_repayment(): void
    {
        /** @var \App\Models\Admin $admin */
        $admin = Admin::factory()->create();
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $loan = Loan::factory()->create([
            'user_id' => $user->id,
            'status' => 'approved',
            'amount' => 100000,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.repayments.store', $loan), [
                'amount' => 25000,
                'payment_date' => now()->format('Y-m-d'),
                'payment_method' => 'Bank Transfer',
                'remarks' => 'First installment',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('repayments', [
            'loan_id' => $loan->id,
            'amount' => 25000,
        ]);
    }

    public function test_loan_balance_remaining_calculated_correctly(): void
    {
        $loan = Loan::factory()->create([
            'amount' => 100000,
            'status' => 'approved',
        ]);

        Repayment::factory()->create([
            'loan_id' => $loan->id,
            'amount' => 30000,
        ]);

        Repayment::factory()->create([
            'loan_id' => $loan->id,
            'amount' => 20000,
        ]);

        $loan->refresh();

        $this->assertEquals(50000, $loan->amount_repaid);
        $this->assertEquals(50000, $loan->balance_remaining);
    }

    public function test_loan_amount_repaid_sums_all_repayments(): void
    {
        $loan = Loan::factory()->create([
            'amount' => 200000,
            'status' => 'approved',
        ]);

        Repayment::factory()->count(4)->create([
            'loan_id' => $loan->id,
            'amount' => 10000,
        ]);

        $loan->refresh();

        $this->assertEquals(40000, $loan->amount_repaid);
        $this->assertEquals(160000, $loan->balance_remaining);
    }
}
