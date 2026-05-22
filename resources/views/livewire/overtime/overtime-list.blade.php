<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-100">Overtime</h2>
            <p class="text-slate-400 mt-1">Track your overtime hours</p>
        </div>
        <a href="/overtime/create" class="bg-cyan-400 text-[#0F1219] font-semibold px-4 py-2 rounded-lg hover:bg-cyan-300 transition text-sm">
            + Add Overtime
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
    @elseif(empty($overtimes))
        <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-8 text-center">
            <svg class="w-12 h-12 text-slate-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-slate-400">No overtime records yet</p>
            <a href="/overtime/create" class="text-cyan-400 text-sm mt-2 inline-block hover:text-cyan-300">Add your first overtime</a>
        </div>
    @else
        <div class="space-y-3">
            @foreach($overtimes as $overtime)
                <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-4 flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <span class="text-slate-100 font-medium">{{ $overtime['date'] ?? '' }}</span>
                            @if($overtime['is_holiday'] ?? false)
                                <span class="bg-yellow-400/10 text-yellow-400 text-xs px-2 py-0.5 rounded-full">Holiday</span>
                            @endif
                            <span class="bg-cyan-400/10 text-cyan-400 text-xs px-2 py-0.5 rounded-full">{{ $overtime['status'] ?? 'pending' }}</span>
                        </div>
                        <div class="flex items-center gap-4 mt-1">
                            <span class="text-slate-400 text-sm">{{ $overtime['hours'] ?? 0 }} hours</span>
                            @if($overtime['amount'] ?? null)
                                <span class="text-green-400 text-sm">Rp {{ number_format($overtime['amount'], 0, ',', '.') }}</span>
                            @endif
                        </div>
                        @if($overtime['description'] ?? null)
                            <p class="text-slate-500 text-sm mt-1">{{ $overtime['description'] }}</p>
                        @endif
                    </div>
                    <button wire:click="delete({{ $overtime['id'] }})" wire:confirm="Are you sure you want to delete this overtime record?"
                        class="text-red-400 hover:text-red-300 p-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>
