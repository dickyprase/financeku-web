<div>
    <div class="mb-6">
        <a href="/profile" class="text-cyan-400 hover:text-cyan-300 text-sm">&larr; Back to Profile</a>
        <h2 class="text-2xl font-bold text-slate-100 mt-2">Change Password</h2>
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
                <label class="block text-sm text-slate-400 mb-1">Current Password</label>
                <input type="password" wire:model="old_password"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="••••••••">
                @error('old_password') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">New Password</label>
                <input type="password" wire:model="new_password"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="••••••••">
                @error('new_password') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Confirm New Password</label>
                <input type="password" wire:model="new_password_confirmation"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Change Password</span>
                <span wire:loading>Updating...</span>
            </button>
        </form>
    </div>
</div>
