<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingsController extends Controller
{
    /**
     * Display the user's savings transaction history.
     */
    public function index()
    {
        $transactions = Auth::user()->savingsTransactions()->latest()->paginate(20);
        $profile = Auth::user()->profile;
        $balance = $profile->total_contributions ?? 0;

        return view('savings.index', compact('transactions', 'profile', 'balance'));
    }
}
