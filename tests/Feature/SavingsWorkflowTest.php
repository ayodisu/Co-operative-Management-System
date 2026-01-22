<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use App\Models\MemberProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SavingsWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_deposit_savings(): void
    {
        /** @var \App\Models\Admin $admin */
        $admin = Admin::factory()->create();
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        MemberProfile::factory()->create([
            'user_id' => $user->id,
            'total_contributions' => 50000,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.savings.store', $user), [
                'type' => 'deposit',
                'amount' => 10000,
                'description' => 'Monthly Contribution',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('savings_transactions', [
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => 10000,
            'balance_after' => 60000,
        ]);

        $this->assertEquals(60000, $user->profile->fresh()->total_contributions);
    }

    public function test_admin_can_withdraw_savings(): void
    {
        /** @var \App\Models\Admin $admin */
        $admin = Admin::factory()->create();
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        MemberProfile::factory()->create([
            'user_id' => $user->id,
            'total_contributions' => 50000,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.savings.store', $user), [
                'type' => 'withdrawal',
                'amount' => 20000,
                'description' => 'Emergency Withdraw',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('savings_transactions', [
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'amount' => 20000,
            'balance_after' => 30000,
        ]);

        $this->assertEquals(30000, $user->profile->fresh()->total_contributions);
    }
}
