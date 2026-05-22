<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-100">Edit Profile</h2>
        <p class="text-slate-400 mt-1">Update your personal information</p>
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
                <label class="block text-sm text-slate-400 mb-1">Name</label>
                <input type="text" wire:model="name"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="Your name">
                @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Phone</label>
                <input type="text" wire:model="phone"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="08xxxxxxxxxx">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Telegram</label>
                <input type="text" wire:model="telegram"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="@username">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Monthly Salary</label>
                <input type="number" wire:model="salary"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="0">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Meal Allowance</label>
                <input type="number" wire:model="meal_allowance"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="0">
            </div>

            <button type="submit" class="w-full bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Changes</span>
                <span wire:loading>Saving...</span>
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-[#2D3748]">
            <a href="/profile/password" class="text-cyan-400 hover:text-cyan-300 text-sm">Change Password &rarr;</a>
        </div>
    </div>
</div>
