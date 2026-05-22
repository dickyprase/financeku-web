<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-100">Transfer Between Wallets</h2>
        <p class="text-slate-400 mt-1">Move money between your wallets</p>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
            <p class="text-red-400 text-sm">{{ $error }}</p>
        </div>
    @endif

    @if($success)
        <div class="bg-green-500/10 border border-green-500/50 rounded-lg p-3 mb-4">
            <p class="text-green-400 text-sm">{{ $success }}</p>
        </div>
    @endif

    <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-6">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="block text-sm text-slate-400 mb-1">From Wallet</label>
                <select wire:model="from_wallet_id"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                    <option value="">Select source wallet</option>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet['id'] }}">{{ $wallet['name'] }} (Rp {{ number_format($wallet['balance'] ?? 0, 0, ',', '.') }})</option>
                    @endforeach
                </select>
                @error('from_wallet_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">To Wallet</label>
                <select wire:model="to_wallet_id"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                    <option value="">Select destination wallet</option>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet['id'] }}">{{ $wallet['name'] }} (Rp {{ number_format($wallet['balance'] ?? 0, 0, ',', '.') }})</option>
                    @endforeach
                </select>
                @error('to_wallet_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Amount</label>
                <input type="number" wire:model="amount"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="0">
                @error('amount') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Admin Fee (optional)</label>
                <input type="number" wire:model="admin_fee"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="0">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Description (optional)</label>
                <input type="text" wire:model="description"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="Transfer note">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Date</label>
                <input type="date" wire:model="date"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                @error('date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Transfer</span>
                <span wire:loading>Processing...</span>
            </button>
        </form>
    </div>
</div>
