<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_apply_for_loan(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        \App\Models\MemberProfile::factory()->create([
            'user_id' => $user->id,
            'monthly_contribution' => 10000, // Limit = 300,000
        ]);

        $response = $this->actingAs($user)->post(route('loans.store'), [
            'amount' => 50000,
            'duration_months' => 6,
            'purpose' => 'Emergency medical expenses',
            'agree' => 1,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('loans', [
            'user_id' => $user->id,
            'amount' => 50000,
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_approve_loan(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        /** @var \App\Models\Admin $admin */
        $admin = Admin::factory()->create();

        $loan = Loan::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'amount' => 100000,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->put(route('admin.loans.update', $loan), [
                'status' => 'approved',
                'admin_remark' => 'Approved by test',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('loans', [
            'id' => $loan->id,
            'status' => 'approved',
        ]);
    }

    public function test_admin_can_reject_loan(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        /** @var \App\Models\Admin $admin */
        $admin = Admin::factory()->create();

        $loan = Loan::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'amount' => 500000,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->put(route('admin.loans.update', $loan), [
                'status' => 'rejected',
                'admin_remark' => 'Exceeds loan limit',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('loans', [
            'id' => $loan->id,
            'status' => 'rejected',
            'admin_remark' => 'Exceeds loan limit',
        ]);
    }

    public function test_loan_approval_increases_user_balance(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['balance' => 0]);
        /** @var \App\Models\Admin $admin */
        $admin = Admin::factory()->create();

        $loan = Loan::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'amount' => 75000,
        ]);

        $this->actingAs($admin, 'admin')
            ->put(route('admin.loans.update', $loan), [
                'status' => 'approved',
            ]);

        $user->refresh();
        $this->assertEquals(75000, $user->balance);
    }
}
