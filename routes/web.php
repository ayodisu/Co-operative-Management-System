<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoanController as adminLoanController;
use App\Http\Controllers\Admin\MemberController as adminMemberController;
use App\Http\Controllers\Admin\RepaymentController as adminRepaymentController;
use App\Http\Controllers\Admin\SettingController as adminSettingController;
use App\Http\Controllers\Admin\SupportTicketController as adminSupportTicketController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $profile = $user->profile;
        $activeLoansCount = $user->loans()->where('status', 'running')->count();
        $pendingLoansCount = $user->loans()->where('status', 'pending')->count();

        return view('dashboard.user', compact('profile', 'activeLoansCount', 'pendingLoansCount'));
    })->middleware('verified')->name('user.dashboard');


    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/member/profile/update', [MemberProfileController::class, 'update'])->name('member.profile.update');

    // Loans
    Route::get('/loans/apply', [LoanController::class, 'apply'])->name('loans.apply');
    Route::post('/loans/apply', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/history', [LoanController::class, 'history'])->name('loans.history');
    Route::get('/loans/schedule', [LoanController::class, 'schedule'])->name('loans.schedule');

    // Support
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support', [SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket}', [SupportController::class, 'show'])->name('support.show');
    Route::post('/support/{ticket}/reply', [SupportController::class, 'reply'])->name('support.reply');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // The main admin landing page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Existing member routes
    Route::prefix('members')->name('members.')->group(function () {
        Route::get('/', [adminMemberController::class, 'index'])->name('index');
        Route::get('/{member}', [adminMemberController::class, 'show'])->name('show');
        Route::put('/{member}/suspend', [adminMemberController::class, 'suspend'])->name('suspend');
        Route::delete('/{member}', [adminMemberController::class, 'destroy'])->name('destroy');
        Route::get('/{member}/edit', [adminMemberController::class, 'edit'])->name('edit');
        Route::patch('/{member}', [adminMemberController::class, 'update'])->name('update');
    });

    // Loans Management
    Route::get('/loans', [adminLoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{loan}', [adminLoanController::class, 'show'])->name('loans.show');
    Route::put('/loans/{loan}', [adminLoanController::class, 'update'])->name('loans.update');
    Route::post('/loans/{loan}/repayments', [adminRepaymentController::class, 'store'])->name('repayments.store');

    // Repayments
    Route::get('/repayments', [adminRepaymentController::class, 'index'])->name('repayments.index');

    // Support Tickets
    Route::get('/support-tickets', [adminSupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('/support-tickets/{id}', [adminSupportTicketController::class, 'show'])->name('support.show');
    Route::post('/support-tickets/{ticket}/reply', [adminSupportTicketController::class, 'reply'])->name('support.reply');
    Route::post('/support-tickets/{ticket}/close', [adminSupportTicketController::class, 'close'])->name('support.close');

    // System Settings
    Route::get('/settings', [adminSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [adminSettingController::class, 'update'])->name('settings.update');

    // Financial Reports
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

require __DIR__ . '/auth.php';
