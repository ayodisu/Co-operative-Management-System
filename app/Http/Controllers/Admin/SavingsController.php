<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SavingsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingsController extends Controller
{
    /**
     * Display a listing of all savings transactions.
     */
    public function index(Request $request)
    {
        $query = SavingsTransaction::with('user')->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->paginate(20);

        return view('admin.savings.index', compact('transactions'));
    }

    /**
     * Store a new savings transaction (Deposit/Withdrawal).
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'type' => 'required|in:deposit,withdrawal',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $profile = $user->profile;

        if (!$profile) {
            return back()->withErrors(['amount' => 'User does not have a profile.']);
        }

        if ($request->type === 'withdrawal' && $request->amount > $profile->total_contributions) {
            return back()->withErrors(['amount' => 'Insufficient funds for withdrawal.']);
        }

        DB::transaction(function () use ($request, $user, $profile) {
            $amount = $request->amount;
            $currentBalance = $profile->total_contributions;

            $newBalance = $request->type === 'deposit'
                ? $currentBalance + $amount
                : $currentBalance - $amount;

            $user->savingsTransactions()->create([
                'type' => $request->type,
                'amount' => $amount,
                'balance_after' => $newBalance,
                'description' => $request->description,
            ]);

            $profile->update(['total_contributions' => $newBalance]);
        });

        return back()->with('success', ucfirst($request->type) . ' recorded successfully.');
    }
}
