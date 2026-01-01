<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Repayment;
use App\Models\MemberProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaymentController extends Controller
{
    /**
     * Display a listing of recent repayments.
     */
    public function index()
    {
        $repayments = Repayment::with(['loan.user'])->latest()->paginate(20);
        return view('admin.repayments.index', compact('repayments'));
    }

    /**
     * Store a newly created repayment in storage.
     */
    public function store(Request $request, Loan $loan)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        if ($request->amount > $loan->balance_remaining) {
            return back()->withErrors(['amount' => 'Repayment amount cannot exceed the remaining loan balance (₦' . number_format($loan->balance_remaining, 2) . ').']);
        }

        DB::transaction(function () use ($request, $loan) {
            $repayment = $loan->repayments()->create([
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'remarks' => $request->remarks,
            ]);

            if ($loan->user && $loan->user->profile) {
                $loan->user->profile->decrement('current_loan_balance', $request->amount);
            }

            if ($loan->fresh()->balance_remaining <= 0) {
                $loan->update(['status' => 'paid']);
            }
        });

        return back()->with('success', 'Repayment of ₦' . number_format($request->amount, 2) . ' recorded successfully.');
    }
}
