<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Personal App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#0F1219] text-slate-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-cyan-400">Personal App</h1>
            <p class="text-slate-400 mt-2">Manage your personal finances</p>
        </div>
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
