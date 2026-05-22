<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-100">Monthly Report</h2>
        <p class="text-slate-400 mt-1">Cashflow summary by month</p>
    </div>

    <div class="mb-6">
        <input type="month" wire:model.live="month"
            class="bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
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
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <span class="text-slate-400 text-sm">Total Income</span>
                <p class="text-2xl font-bold text-green-400 mt-1">Rp {{ number_format($report['total_income'] ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <span class="text-slate-400 text-sm">Total Expense</span>
                <p class="text-2xl font-bold text-red-400 mt-1">Rp {{ number_format($report['total_expense'] ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <span class="text-slate-400 text-sm">Net</span>
                @php $net = ($report['total_income'] ?? 0) - ($report['total_expense'] ?? 0); @endphp
                <p class="text-2xl font-bold {{ $net >= 0 ? 'text-green-400' : 'text-red-400' }} mt-1">
                    Rp {{ number_format(abs($net), 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- Category Breakdown -->
        @if(!empty($report['categories'] ?? []))
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                <h3 class="text-lg font-semibold text-slate-100 mb-4">By Category</h3>
                <div class="space-y-3">
                    @foreach($report['categories'] as $category)
                        <div class="flex items-center justify-between">
                            <span class="text-slate-300">{{ $category['name'] ?? 'Uncategorized' }}</span>
                            <span class="text-slate-100 font-medium">Rp {{ number_format($category['total'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Transactions List -->
        @if(!empty($report['transactions'] ?? []))
            <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5 mt-4">
                <h3 class="text-lg font-semibold text-slate-100 mb-4">Transactions</h3>
                <div class="space-y-2">
                    @foreach($report['transactions'] as $tx)
                        <div class="flex items-center justify-between py-2 border-b border-[#2D3748] last:border-0">
                            <div>
                                <span class="text-slate-100 text-sm">{{ $tx['description'] ?? '' }}</span>
                                <span class="text-slate-500 text-xs ml-2">{{ $tx['date'] ?? '' }}</span>
                            </div>
                            <span class="{{ ($tx['type'] ?? '') === 'income' ? 'text-green-400' : 'text-red-400' }} text-sm font-medium">
                                {{ ($tx['type'] ?? '') === 'income' ? '+' : '-' }}Rp {{ number_format($tx['amount'] ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>
