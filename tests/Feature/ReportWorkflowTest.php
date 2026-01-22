<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\MemberProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_savings_statement_can_be_downloaded(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        MemberProfile::factory()->create([
            'user_id' => $user->id,
            'total_contributions' => 50000,
        ]);

        $user->savingsTransactions()->create([
            'type' => 'deposit',
            'amount' => 50000,
            'balance_after' => 50000,
            'description' => 'Initial Deposit',
        ]);

        $response = $this->actingAs($user)
            ->get(route('reports.savings', $user));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_loan_statement_can_be_downloaded(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $loan = Loan::factory()->create([
            'user_id' => $user->id,
            'amount' => 100000,
        ]);

        $response = $this->actingAs($user)
            ->get(route('reports.loan', $loan));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }
}
