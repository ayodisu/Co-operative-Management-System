<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function savingsStatement(User $user)
    {
        $transactions = $user->savingsTransactions()->latest()->get();
        $profile = $user->profile;

        $pdf = Pdf::loadView('reports.savings_statement', compact('user', 'transactions', 'profile'));

        return $pdf->download("savings_statement_{$user->name}.pdf");
    }

    public function loanStatement(Loan $loan)
    {
        $loan->load('repayments', 'user.profile');

        $pdf = Pdf::loadView('reports.loan_statement', compact('loan'));

        return $pdf->download("loan_statement_{$loan->id}.pdf");
    }
}
