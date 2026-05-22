<div>
    <div class="mb-6">
        <a href="/cashflow" class="text-cyan-400 hover:text-cyan-300 text-sm">&larr; Back to Transactions</a>
        <h2 class="text-2xl font-bold text-slate-100 mt-2">Add Transaction</h2>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
            <p class="text-red-400 text-sm">{{ $error }}</p>
        </div>
    @endif

    <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-6">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Type</label>
                <div class="flex gap-3">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" wire:model="type" value="expense" class="hidden peer">
                        <div class="peer-checked:border-red-400 peer-checked:bg-red-400/10 border border-[#2D3748] rounded-lg p-3 text-center transition">
                            <span class="text-sm peer-checked:text-red-400 text-slate-400">Expense</span>
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" wire:model="type" value="income" class="hidden peer">
                        <div class="peer-checked:border-green-400 peer-checked:bg-green-400/10 border border-[#2D3748] rounded-lg p-3 text-center transition">
                            <span class="text-sm peer-checked:text-green-400 text-slate-400">Income</span>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Amount</label>
                <input type="number" wire:model="amount"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="0">
                @error('amount') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Description</label>
                <input type="text" wire:model="description"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="What was this for?">
                @error('description') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Date</label>
                <input type="date" wire:model="date"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                @error('date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Wallet</label>
                <select wire:model="wallet_id"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                    <option value="">Select wallet</option>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet['id'] }}">{{ $wallet['name'] }}</option>
                    @endforeach
                </select>
                @error('wallet_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Category (optional)</label>
                <select wire:model="category_id"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                    <option value="">No category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Transaction</span>
                <span wire:loading>Saving...</span>
            </button>
        </form>
    </div>
</div>
