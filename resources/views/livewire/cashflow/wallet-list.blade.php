<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-100">Wallets</h2>
            <p class="text-slate-400 mt-1">Manage your wallets and accounts</p>
        </div>
        <button wire:click="$set('showForm', true)" class="bg-cyan-400 text-[#0F1219] font-semibold px-4 py-2 rounded-lg hover:bg-cyan-300 transition text-sm">
            + Add Wallet
        </button>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
            <p class="text-red-400 text-sm">{{ $error }}</p>
        </div>
    @endif

    <!-- Create Form Modal -->
    @if($showForm)
        <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-6 mb-6">
            <h3 class="text-lg font-semibold text-slate-100 mb-4">New Wallet</h3>
            <form wire:submit="save" class="space-y-4">
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Name</label>
                    <input type="text" wire:model="name"
                        class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                        placeholder="e.g. BCA, Cash, GoPay">
                    @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Type</label>
                    <select wire:model="type"
                        class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                        <option value="cash">Cash</option>
                        <option value="bank">Bank Account</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Initial Balance</label>
                    <input type="number" wire:model="balance"
                        class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                        placeholder="0">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition">
                        Save
                    </button>
                    <button type="button" wire:click="$set('showForm', false)" class="flex-1 border border-[#2D3748] text-slate-300 py-2.5 rounded-lg hover:bg-[#2D3748] transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    @endif

    @if($loading)
        <div class="flex items-center justify-center py-12">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-cyan-400"></div>
        </div>
    @elseif(empty($wallets))
        <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-8 text-center">
            <svg class="w-12 h-12 text-slate-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            <p class="text-slate-400">No wallets yet</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($wallets as $wallet)
                <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs px-2 py-0.5 rounded-full bg-cyan-400/10 text-cyan-400 uppercase">{{ $wallet['type'] ?? 'cash' }}</span>
                        <button wire:click="delete({{ $wallet['id'] }})" wire:confirm="Delete this wallet?"
                            class="text-red-400 hover:text-red-300 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-100">{{ $wallet['name'] }}</h3>
                    <p class="text-2xl font-bold text-cyan-400 mt-2">Rp {{ number_format($wallet['balance'] ?? 0, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
