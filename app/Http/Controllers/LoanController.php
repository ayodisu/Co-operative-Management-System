<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth as SupportFacadesAuth;
use Illuminate\Support\Facades\Redirect;

class LoanController extends Controller
{
    public function apply()
    {
        $user = Auth::user();
        $monthlyContribution = $user->profile->monthly_contribution ?? 0;
        $loanLimit = $monthlyContribution * 30;

        return view('loans.apply', compact('loanLimit', 'monthlyContribution'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'duration_months' => 'required|integer|min:1|max:36',
            'purpose' => 'required|string|max:1000',
            'agree' => 'accepted',
        ]);

        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            return back()->with('error', 'Please complete your profile details first.');
        }

        $monthlyContribution = $profile->monthly_contribution ?? 0;

        if ($monthlyContribution <= 0) {
            return back()->withErrors(['amount' => 'You must have an active monthly contribution set up to apply.']);
        }

        $hasActiveLoan = $user->loans()
            ->whereIn('status', ['pending', 'running'])
            ->exists();

        if ($hasActiveLoan) {
            return back()->withErrors(['amount' => 'You already have a pending or running loan. Please clear it first.']);
        }

        $limit = $monthlyContribution * 30;

        if ($request->amount > $limit) {
            return back()->withErrors([
                'amount' => "You are not eligible for ₦" . number_format($request->amount) .
                    ". Based on your contribution of ₦" . number_format($monthlyContribution) .
                    ", your limit is ₦" . number_format($limit) . "."
            ])->withInput();
        }

        $user->loans()->create([
            'amount' => $validated['amount'],
            'duration_months' => $validated['duration_months'],
            'purpose' => $validated['purpose'],
            'status' => 'pending'
        ]);

        return redirect()->route('user.dashboard')->with('status', 'Loan application submitted successfully!');
    }

    public function schedule()
    {
        $loan = Auth::user()->loans()
            ->whereIn('status', ['pending', 'approved', 'running'])
            ->latest()
            ->first();

        if (!$loan) {
            return view('loans.schedule', ['schedule' => collect([])]);
        }

        // Eager load repayments to calculate actual balance
        $loan->load('repayments');

        $schedule = collect();
        $monthlyPrincipal = $loan->amount / $loan->duration_months;

        $startDate = $loan->created_at->addMonth()->startOfMonth();

        for ($i = 1; $i <= $loan->duration_months; $i++) {
            $dueDate = $startDate->copy()->addMonths($i - 1);
            $status = $dueDate->isPast() ? 'overdue' : 'pending';

            $schedule->push((object)[
                'due_date' => $dueDate,
                'amount' => $monthlyPrincipal,
                'status' => $status,
                'paid_at' => null
            ]);
        }

        return view('loans.schedule', compact('schedule', 'loan'));
    }

    public function history()
    {
        $loans = Auth::user()->loans()->with('repayments')->latest()->get();
        return view('loans.history', compact('loans'));
    }
}
