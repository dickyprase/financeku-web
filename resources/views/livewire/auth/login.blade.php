<div>
    <div class="bg-[#1E2736] border border-[#2D3748] rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-slate-100 mb-6">Sign In</h2>

        @if($error)
            <div class="bg-red-500/10 border border-red-500/50 rounded-lg p-3 mb-4">
                <p class="text-red-400 text-sm">{{ $error }}</p>
            </div>
        @endif

        <form wire:submit="login" class="space-y-4">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Email</label>
                <input type="email" wire:model="email"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="you@example.com">
                @error('email') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Password</label>
                <input type="password" wire:model="password"
                    class="w-full bg-[#0F1219] border border-[#2D3748] rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                    placeholder="••••••••">
                @error('password') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-cyan-400 text-[#0F1219] font-semibold py-2.5 rounded-lg hover:bg-cyan-300 transition disabled:opacity-50" wire:loading.attr="disabled">
                <span wire:loading.remove>Sign In</span>
                <span wire:loading>Signing in...</span>
            </button>
        </form>

        <p class="text-center text-slate-400 text-sm mt-6">
            Don't have an account? <a href="/register" class="text-cyan-400 hover:text-cyan-300">Register</a>
        </p>
    </div>
</div>
