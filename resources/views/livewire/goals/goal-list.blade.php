<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-100">Goals</h2>
            <p class="text-slate-400 mt-1">Track your savings goals</p>
        </div>
        <button wire:click="$set('showForm', true)" class="bg-cyan-400 text-[#0F1219] font-semibold px-4 py-2 rounded-lg hover:bg-cyan-300 transition text-sm">
            + Add Goal
        </button>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
            <p class="text-red-400 text-sm">{{ $error }}</p>
        </div>
    @endif

    <!-- Create Form -->
    @if($showForm)
        <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-6 mb-6">
            <h3 class="text-lg font-semibold text-slate-100 mb-4">New Goal</h3>
            <form wire:submit="save" class="space-y-4">
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Goal Name</label>
                    <input type="text" wire:model="name"
                        class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                        placeholder="e.g. Emergency Fund, Vacation">
                    @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Target Amount</label>
                    <input type="number" wire:model="target_amount"
                        class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                        placeholder="0">
                    @error('target_amount') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Target Date (optional)</label>
                    <input type="date" wire:model="target_date"
                        class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
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
    @elseif(empty($goals))
        <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-8 text-center">
            <svg class="w-12 h-12 text-slate-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            <p class="text-slate-400">No goals yet</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($goals as $goal)
                @php
                    $progress = ($goal['target_amount'] ?? 1) > 0
                        ? min(100, round((($goal['current_amount'] ?? 0) / $goal['target_amount']) * 100))
                        : 0;
                @endphp
                <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-semibold text-slate-100">{{ $goal['name'] }}</h3>
                        <button wire:click="delete({{ $goal['id'] }})" wire:confirm="Delete this goal?"
                            class="text-red-400 hover:text-red-300 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-slate-400">Rp {{ number_format($goal['current_amount'] ?? 0, 0, ',', '.') }} / Rp {{ number_format($goal['target_amount'] ?? 0, 0, ',', '.') }}</span>
                        <span class="text-cyan-400 font-medium">{{ $progress }}%</span>
                    </div>
                    <div class="w-full bg-[#0F1219] rounded-full h-2">
                        <div class="bg-cyan-400 h-2 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                    </div>
                    @if($goal['target_date'] ?? null)
                        <p class="text-slate-500 text-xs mt-2">Target: {{ $goal['target_date'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
