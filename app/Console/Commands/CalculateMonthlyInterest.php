<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CalculateMonthlyInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'interest:calculate {--dry-run : Run without making database changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and credit monthly interest on member savings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $annualRate = \App\Models\Setting::getValue('savings_interest_rate', 5);
        $monthlyRate = ($annualRate / 100) / 12;

        $this->info("Annual Rate: {$annualRate}% | Monthly Multiplier: {$monthlyRate}");

        $count = 0;
        $totalInterest = 0;

        $profiles = \App\Models\MemberProfile::where('total_contributions', '>', 0)->get(); // For small scale, get() is fine. Chunk if needed.

        $bar = $this->output->createProgressBar($profiles->count());

        foreach ($profiles as $profile) {
            $interest = round($profile->total_contributions * $monthlyRate, 2);

            if ($interest > 0) {
                if (!$this->option('dry-run')) {
                    \Illuminate\Support\Facades\DB::transaction(function () use ($profile, $interest) {
                        $newBalance = $profile->total_contributions + $interest;

                        $profile->user->savingsTransactions()->create([
                            'type' => 'interest',
                            'amount' => $interest,
                            'balance_after' => $newBalance,
                            'description' => 'Monthly Interest',
                        ]);

                        $profile->update(['total_contributions' => $newBalance]);
                    });
                }

                $totalInterest += $interest;
                $count++;
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Processed {$count} members. Total Interest Credited: ₦" . number_format($totalInterest, 2));
    }
}
