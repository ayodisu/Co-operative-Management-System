<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Loan;
use App\Models\Repayment;
use App\Models\MemberProfile;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $loanQuery = Loan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        $totalLoans = (clone $loanQuery)->count();

        $approvedLoans = (clone $loanQuery)->whereIn('status', ['running', 'repaid'])->count();

        $loansDisbursedAmount = Loan::whereIn('status', ['running', 'repaid'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->sum('amount');

        $repaymentsCollected = Repayment::whereBetween('payment_date', [$startDate, $endDate])->sum('amount');

        $totalEquity = MemberProfile::sum('total_contributions');

        $recentLoans = Loan::with('user')
            ->whereIn('status', ['running', 'repaid'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->limit(5)
            ->get();

        $recentRepayments = Repayment::with('loan.user')
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->latest('payment_date')
            ->limit(5)
            ->get();

        return view('admin.reports.index', compact(
            'startDate',
            'endDate',
            'totalLoans',
            'approvedLoans',
            'loansDisbursedAmount',
            'repaymentsCollected',
            'totalEquity',
            'recentLoans',
            'recentRepayments'
        ));
    }
}
