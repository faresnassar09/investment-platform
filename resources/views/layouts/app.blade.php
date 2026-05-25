<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Investment Hub - Dashboard') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .neon-text-glow { text-shadow: 0 0 10px rgba(34, 211, 238, 0.6); }
            .neon-btn-glow { box-shadow: 0 0 20px rgba(34, 211, 238, 0.4); }
            .neon-card { box-shadow: 0 0 25px rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.15); }
            .sidebar-link-active { background: linear-gradient(to left, rgba(34, 211, 238, 0.15), transparent); border-right: 4px solid #22d3ee; color: #22d3ee !important; }
            html { scroll-behavior: smooth; }
        </style>
    </head>
    <body class="antialiased min-h-screen text-gray-200 overflow-x-hidden relative" style="font-family: 'Cairo', sans-serif; background-color: #0b0c16;" x-data="{ sidebarOpen: false }">
        
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0" style="background: radial-gradient(circle at 80% 20%, #101430 0%, #0b0c16 70%);"></div>
            <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#22d3ee 0.5px, transparent 0.5px); background-size: 30px 30px;"></div>
        </div>

        <div class="relative z-10 flex min-h-screen">

<button @click="sidebarOpen = !sidebarOpen" class="md:hidden absolute top-5 left-6 z-50 bg-cyan-400 p-2.5 rounded-xl text-slate-950 shadow-md transition-transform active:scale-95">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
</button>

            <aside :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full md:translate-x-0'"
                   class="w-72 fixed md:static inset-y-0 right-0 z-40 bg-[#0d0e1b]/90 md:bg-[#0d0e1b]/50 backdrop-blur-md border-l border-gray-800/60 flex flex-col justify-between transition-transform duration-300 ease-in-out">
                
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-10">
                        <div class="bg-gradient-to-tr from-emerald-500 to-cyan-500 p-2 rounded-xl">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <h1 class="text-white font-black text-lg">Investment <span class="text-cyan-400">Hub</span></h1>
                            <span class="text-[9px] text-gray-500 block -mt-1">Investor Dashboard</span>
                        </div>
                    </div>

                    <nav class="space-y-1.5">
                        <a href="{{route('user.dashboard')}}" class="sidebar-link-active flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                            اللوحة الرئيسية
                        </a>



                        <a href="{{route('user.investment_plans.buy')}}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            شراء خطة
                        </a>

                                            <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            شجرة الأعضاء الإحالية
                        </a>
                         
<a href="{{route('user.deposit.create')}}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
    </svg>
    الإيداع
</a>
<a href="{{route('user.withdraw.create')}}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
    السحب
</a>
<a href="#" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    سجل العمليات
</a>
<a href="#" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138z"></path>
    </svg>
    الرانك
</a>

                        <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-sm font-bold rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/30 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2zm12 0v-11a2 2 0 00-2-2h-2a2 2 0 00-2 2v11a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
                            تقارير الأرباح
                        </a>
                    </nav>
                </div>

                <div class="p-4 border-t border-gray-800/40 bg-[#07080f]/40">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-purple-600/30 border border-purple-500/40 flex items-center justify-center font-bold text-sm text-purple-300">
                                {{ mb_substr(Auth::user()->name ?? 'م', 0, 1) }}
                            </div>
                            <div class="max-w-[130px] truncate">
                                <h4 class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'مستثمر VIP' }}</h4>
                                <span class="text-[10px] text-emerald-400 block font-mono">حساب نشط</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </aside>

            <main class="flex-1 min-w-0 flex flex-col">
                
                <header class="h-20 border-b border-gray-800/40 px-6 md:px-10 flex items-center justify-between bg-[#0b0c16]/30 backdrop-blur-md">
                    <div>
                        <h2 class="text-md font-black text-white">لوحة التحكم</h2>
                        <p class="text-[11px] text-gray-500">أهلاً بك مجدداً، الإحصائيات محدثة في الوقت الفعلي</p>
                    </div>
                    
                    <div class="flex items-center gap-8">
                        <div class="hidden sm:flex items-center gap-2 bg-[#111322]/80 border border-gray-800 rounded-xl px-3 py-1.5 text-xs">
                                                   <livewire:layout.navigation />

                        </div>

                    </div>
                </header>

                <div class="p-6 md:p-10 flex-1 overflow-y-auto">
                    {{ $slot }}
                </div>

            </main>
        </div>

    </body>
</html>