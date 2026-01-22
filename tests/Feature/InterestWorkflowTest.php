<?php

namespace Tests\Feature;

use App\Models\MemberProfile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_interest_calculation_credits_correct_amount(): void
    {
        // Rate 12% per year = 1% per month for easy math
        Setting::setValue('savings_interest_rate', 12);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        MemberProfile::factory()->create([
            'user_id' => $user->id,
            'total_contributions' => 100000,
        ]);

        $this->artisan('interest:calculate')
            ->expectsOutputToContain('Total Interest Credited: ₦1,000.00')
            ->assertExitCode(0);

        $this->assertDatabaseHas('savings_transactions', [
            'user_id' => $user->id,
            'type' => 'interest',
            'amount' => 1000,
            'balance_after' => 101000,
        ]);

        $this->assertEquals(101000, $user->profile->fresh()->total_contributions);
    }

    public function test_dry_run_does_not_credit_interest(): void
    {
        Setting::setValue('savings_interest_rate', 12);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        MemberProfile::factory()->create([
            'user_id' => $user->id,
            'total_contributions' => 100000,
        ]);

        $this->artisan('interest:calculate', ['--dry-run' => true])
            ->expectsOutputToContain('Total Interest Credited: ₦1,000.00') // Logic runs
            ->assertExitCode(0);

        $this->assertDatabaseMissing('savings_transactions', [
            'user_id' => $user->id,
            'type' => 'interest',
        ]);

        $this->assertEquals(100000, $user->profile->fresh()->total_contributions);
    }
}
