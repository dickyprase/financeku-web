<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Personal App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#0F1219] text-slate-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="hidden md:flex md:flex-col w-64 bg-[#1E2736] border-r border-[#2D3748] min-h-screen fixed">
        <div class="p-6 border-b border-[#2D3748]">
            <h1 class="text-xl font-bold text-cyan-400">Personal App</h1>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>
            <a href="/overtime" class="nav-link {{ request()->is('overtime*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Overtime</span>
            </a>
            <a href="/cashflow" class="nav-link {{ request()->is('cashflow*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Cashflow</span>
            </a>
            <a href="/wallets" class="nav-link {{ request()->is('wallets*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                <span>Wallets</span>
            </a>
            <a href="/transfer" class="nav-link {{ request()->is('transfer*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                <span>Transfer</span>
            </a>
            <a href="/goals" class="nav-link {{ request()->is('goals*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <span>Goals</span>
            </a>
            <a href="/reports" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <span>Reports</span>
            </a>

            <div class="pt-4 mt-4 border-t border-[#2D3748]">
                <a href="/profile" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profile</span>
                </a>
                <form method="POST" action="/logout" class="mt-1">
                    @csrf
                    <button type="submit" class="nav-link w-full text-left text-red-400 hover:text-red-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Mobile header -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-[#1E2736] border-b border-[#2D3748] p-4 z-50 flex items-center justify-between">
        <h1 class="text-lg font-bold text-cyan-400">Personal App</h1>
        <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="text-slate-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden fixed inset-0 bg-[#0F1219]/90 z-40 pt-16">
        <nav class="bg-[#1E2736] p-4 space-y-1 border-b border-[#2D3748]">
            <a href="/" class="nav-link">Dashboard</a>
            <a href="/overtime" class="nav-link">Overtime</a>
            <a href="/cashflow" class="nav-link">Cashflow</a>
            <a href="/wallets" class="nav-link">Wallets</a>
            <a href="/transfer" class="nav-link">Transfer</a>
            <a href="/goals" class="nav-link">Goals</a>
            <a href="/reports" class="nav-link">Reports</a>
            <a href="/profile" class="nav-link">Profile</a>
            <form method="POST" action="/logout">@csrf<button type="submit" class="nav-link w-full text-left text-red-400">Logout</button></form>
        </nav>
    </div>

    <!-- Main content -->
    <main class="flex-1 md:ml-64 p-6 pt-20 md:pt-6 min-h-screen">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
