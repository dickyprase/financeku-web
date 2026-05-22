<div>
    <div class="mb-6">
        <a href="/overtime" class="text-cyan-400 hover:text-cyan-300 text-sm">&larr; Back to Overtime</a>
        <h2 class="text-2xl font-bold text-slate-100 mt-2">Log Overtime</h2>
    </div>

    @if($error)
        <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
            <p class="text-red-400 text-sm">{{ $error }}</p>
        </div>
    @endif

    <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-6">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Date</label>
                <input type="date" wire:model="date"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                @error('date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Hours</label>
                <input type="number" step="0.5" wire:model.live.debounce.500ms="hours" wire:change="calculate"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="e.g. 2">
                @error('hours') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model.live="is_holiday" wire:change="calculate" id="is_holiday"
                    class="w-4 h-4 rounded border-[#2D3748] bg-[#0F1219] text-cyan-400 focus:ring-cyan-400">
                <label for="is_holiday" class="text-sm text-slate-300">Holiday / Weekend</label>
            </div>

            @if($calculation)
                <div class="bg-cyan-400/5 border border-cyan-400/20 rounded-lg p-3">
                    <p class="text-cyan-400 text-sm font-medium">Estimated: Rp {{ number_format($calculation['amount'] ?? 0, 0, ',', '.') }}</p>
                </div>
            @endif

            <div>
                <label class="block text-sm text-slate-400 mb-1">Description (optional)</label>
                <textarea wire:model="description" rows="3"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition resize-none"
                    placeholder="What did you work on?"></textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Overtime</span>
                <span wire:loading>Saving...</span>
            </button>
        </form>
    </div>
</div>
