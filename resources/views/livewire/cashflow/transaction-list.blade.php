<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-100">Transactions</h2>
            <p class="text-slate-400 mt-1">Track your income and expenses</p>
        </div>
        <a href="/cashflow/create" class="bg-cyan-400 text-[#0F1219] font-semibold px-4 py-2 rounded-lg hover:bg-cyan-300 transition text-sm">
            + Add Transaction
        </a>
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
    @elseif(empty($transactions))
        <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-8 text-center">
            <svg class="w-12 h-12 text-slate-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <p class="text-slate-400">No transactions yet</p>
            <a href="/cashflow/create" class="text-cyan-400 text-sm mt-2 inline-block hover:text-cyan-300">Add your first transaction</a>
        </div>
    @else
        <div class="space-y-3">
            @foreach($transactions as $transaction)
                <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-4 flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <span class="text-slate-100 font-medium">{{ $transaction['description'] ?? '' }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ ($transaction['type'] ?? '') === 'income' ? 'bg-green-400/10 text-green-400' : 'bg-red-400/10 text-red-400' }}">
                                {{ ucfirst($transaction['type'] ?? '') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-slate-400 text-sm">{{ $transaction['date'] ?? '' }}</span>
                            @if($transaction['category']['name'] ?? null)
                                <span class="text-slate-500 text-sm">{{ $transaction['category']['name'] }}</span>
                            @endif
                            @if($transaction['wallet']['name'] ?? null)
                                <span class="text-slate-500 text-sm">{{ $transaction['wallet']['name'] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="font-semibold {{ ($transaction['type'] ?? '') === 'income' ? 'text-green-400' : 'text-red-400' }}">
                            {{ ($transaction['type'] ?? '') === 'income' ? '+' : '-' }}Rp {{ number_format($transaction['amount'] ?? 0, 0, ',', '.') }}
                        </span>
                        <button wire:click="delete({{ $transaction['id'] }})" wire:confirm="Delete this transaction?"
                            class="text-red-400 hover:text-red-300 p-2 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
