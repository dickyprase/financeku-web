<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard;
use App\Livewire\Overtime\OvertimeList;
use App\Livewire\Overtime\OvertimeForm;
use App\Livewire\Cashflow\TransactionList;
use App\Livewire\Cashflow\TransactionForm;
use App\Livewire\Cashflow\WalletList;
use App\Livewire\Cashflow\Transfer;
use App\Livewire\Goals\GoalList;
use App\Livewire\Reports\MonthlyReport;
use App\Livewire\Profile\ProfileEdit;
use App\Livewire\Profile\ChangePassword;
use App\Services\ApiClient;

// Guest routes
Route::middleware('guest.api')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Logout
Route::post('/logout', function (ApiClient $api) {
    $api->clearTokens();
    return redirect('/login');
})->name('logout');

// Protected routes
Route::middleware('api.auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/overtime', OvertimeList::class)->name('overtime.index');
    Route::get('/overtime/create', OvertimeForm::class)->name('overtime.create');
    Route::get('/cashflow', TransactionList::class)->name('cashflow.index');
    Route::get('/cashflow/create', TransactionForm::class)->name('cashflow.create');
    Route::get('/wallets', WalletList::class)->name('wallets.index');
    Route::get('/transfer', Transfer::class)->name('transfer');
    Route::get('/goals', GoalList::class)->name('goals.index');
    Route::get('/reports', MonthlyReport::class)->name('reports.index');
    Route::get('/profile', ProfileEdit::class)->name('profile.edit');
    Route::get('/profile/password', ChangePassword::class)->name('profile.password');
});
