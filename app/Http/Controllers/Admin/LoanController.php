<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\LoanStatusUpdated;
use App\Models\ActivityLog;

class LoanController extends Controller
{
    public function index()
    {
        $pendingLoans = Loan::with('user.profile')->where('status', 'pending')->latest()->get();
        $activeLoans = Loan::with('user.profile')->where('status', 'approved')->orWhere('status', 'running')->latest()->get();

        return view('admin.loans.index', compact('pendingLoans', 'activeLoans'));
    }

    public function show(Loan $loan)
    {
        $loan->load(['user.profile', 'repayments']);
        return view('admin.loans.show', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_remark' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $loan) {
            $oldStatus = $loan->status;

            $loan->update([
                'status' => $request->status,
                'admin_remark' => $request->admin_remark ?? 'Processed by Admin',
            ]);

            if ($request->status === 'approved') {

                $loan->user->increment('balance', $loan->amount);

                $profile = $loan->user->profile;
                if ($profile) {
                    $profile->increment('current_loan_balance', $loan->amount);
                }
            }

            if ($oldStatus !== $request->status) {
                $loan->user->notify(new LoanStatusUpdated($loan));

                // Log the activity
                ActivityLog::log(
                    "Loan #{$loan->id} {$request->status} for {$loan->user->name}",
                    $loan,
                    [
                        'old_status' => $oldStatus,
                        'new_status' => $request->status,
                        'amount' => $loan->amount,
                        'admin_remark' => $request->admin_remark,
                    ],
                    'loan'
                );
            }
        });

        return redirect()->route('admin.loans.index')
            ->with('status', 'Loan application ' . $request->status . ' successfully!');
    }
}
