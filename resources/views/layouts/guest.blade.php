<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Investment Hub') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .neon-text-glow { text-shadow: 0 0 10px rgba(34, 211, 238, 0.6); }
            .neon-btn-glow { box-shadow: 0 0 20px rgba(34, 211, 238, 0.4); }
            .neon-card { box-shadow: 0 0 25px rgba(139, 92, 246, 0.15); border: 1px solid rgba(139, 92, 246, 0.2); }
            html { scroll-behavior: smooth; }
        </style>
    </head>
    <body class="antialiased min-h-screen text-gray-200 overflow-x-hidden relative" style="font-family: 'Cairo', sans-serif; background-color: #0b0c16;">
        
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0" style="background: radial-gradient(circle at 20% 30%, #1a103c 0%, #0b0c16 60%);"></div>
            <div class="absolute inset-0 opacity-25" style="background-image: radial-gradient(#22d3ee 0.5px, transparent 0.5px); background-size: 30px 30px;"></div>
            <div class="absolute top-1/2 right-10 w-[600px] h-[600px] bg-cyan-950/20 rounded-full blur-[140px]"></div>
            <div class="absolute bottom-10 left-10 w-[400px] h-[400px] bg-purple-950/20 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full">
            {{ $slot }}
        </div>

    </body>
</html>