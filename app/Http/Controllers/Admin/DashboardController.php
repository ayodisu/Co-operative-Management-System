<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loan;
use App\Models\MemberProfile;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $pendingRequestsCount = Loan::where('status', 'pending')->count();
        $totalEquity = MemberProfile::sum('total_contributions');
        $totalLoanDisbursed = Loan::where('status', 'approved')->sum('amount');
        $openTicketsCount = Ticket::where('status', 'open')->count();

        return view('dashboard.admin', compact(
            'totalMembers',
            'totalAdmins',
            'pendingRequestsCount',
            'totalEquity',
            'totalLoanDisbursed',
            'openTicketsCount'
        ));
    }
}
