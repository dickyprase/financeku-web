<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-100">Dashboard</h2>
        <p class="text-slate-400 mt-1">Welcome back!</p>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
            <p class="text-red-400 text-sm">{{ $error }}</p>
        </div>
    @endif

    @if($loading)
        <div class="flex items-center justify-center py-12">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-cyan-400"></div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Balance -->
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-slate-400 text-sm">Total Balance</span>
                    <div class="w-8 h-8 bg-cyan-400/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-slate-100">Rp {{ number_format($stats['total_balance'] ?? 0, 0, ',', '.') }}</p>
            </div>

            <!-- Monthly Income -->
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-slate-400 text-sm">Monthly Income</span>
                    <div class="w-8 h-8 bg-green-400/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-green-400">Rp {{ number_format($stats['monthly_income'] ?? 0, 0, ',', '.') }}</p>
            </div>

            <!-- Monthly Expense -->
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-slate-400 text-sm">Monthly Expense</span>
                    <div class="w-8 h-8 bg-red-400/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-red-400">Rp {{ number_format($stats['monthly_expense'] ?? 0, 0, ',', '.') }}</p>
            </div>

            <!-- Overtime Pending -->
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-slate-400 text-sm">Overtime Pending</span>
                    <div class="w-8 h-8 bg-yellow-400/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-yellow-400">Rp {{ number_format($stats['overtime_pending'] ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-slate-100 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <a href="/cashflow/create" class="bg-[#1E2736] border border-[#2D3748] rounded-xl p-4 text-center hover:border-cyan-400/50 transition">
                    <svg class="w-6 h-6 text-cyan-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    <span class="text-sm text-slate-300">Add Transaction</span>
                </a>
                <a href="/overtime/create" class="bg-[#1E2736] border border-[#2D3748] rounded-xl p-4 text-center hover:border-cyan-400/50 transition">
                    <svg class="w-6 h-6 text-cyan-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm text-slate-300">Log Overtime</span>
                </a>
                <a href="/transfer" class="bg-[#1E2736] border border-[#2D3748] rounded-xl p-4 text-center hover:border-cyan-400/50 transition">
                    <svg class="w-6 h-6 text-cyan-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    <span class="text-sm text-slate-300">Transfer</span>
                </a>
                <a href="/reports" class="bg-[#1E2736] border border-[#2D3748] rounded-xl p-4 text-center hover:border-cyan-400/50 transition">
                    <svg class="w-6 h-6 text-cyan-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span class="text-sm text-slate-300">Reports</span>
                </a>
            </div>
        </div>
    @endif
</div>
