<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: route('user.dashboard', absolute: false), navigate: true);
};

?>

<div class="min-h-screen flex flex-col justify-center items-center px-6 relative z-10" dir="rtl">
    
    <div class="w-full max-w-md bg-[#111322]/80 backdrop-blur-md p-8 rounded-3xl border border-purple-500/20 shadow-2xl neon-card">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 justify-center mb-2">
                <div class="bg-gradient-to-tr from-emerald-500 to-cyan-500 p-2 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h1 class="text-white font-black text-xl tracking-tight">Investment <span class="text-cyan-400">Hub</span></h1>
            </div>
            <p class="text-xs text-gray-400">سجل دخولك لمتابعة استثماراتك وشبكتك الإحالية</p>
        </div>

        <x-auth-session-status class="mb-4 text-emerald-400 text-sm text-center" :status="session('status')" />

        <form wire:submit="login" class="space-y-5">
            
            <div>
                <label for="email" class="block text-xs font-bold text-gray-400 mb-1.5">البريد الإلكتروني</label>
                <div class="relative">
                    <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                           class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                           placeholder="name@example.com">
                </div>
                @if($errors->has('form.email'))
                    <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('form.email') }}</span>
                @endif
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-xs font-bold text-gray-400">كلمة المرور</label>
                    @if (Route::has('password.request'))
                        <a class="text-xs text-purple-400 hover:text-purple-300 transition" href="{{ route('password.request') }}" wire:navigate>
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                           placeholder="••••••••">
                </div>
                @if($errors->has('form.password'))
                    <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('form.password') }}</span>
                @endif
            </div>

            <div class="flex items-center justify-between pt-1">
                <label for="remember" class="inline-flex items-center cursor-pointer select-none">
                    <div class="relative">
                        <input wire:model="form.remember" id="remember" type="checkbox" name="remember" 
                               class="rounded border-gray-800 bg-[#161930] text-cyan-500 shadow-sm focus:ring-0 focus:ring-offset-0 w-4 h-4 cursor-pointer">
                    </div>
                    <span class="ms-2 text-xs font-semibold text-gray-400 hover:text-gray-300 transition">تذكرني على هذا الجهاز</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full bg-cyan-400 text-slate-950 font-black py-3 rounded-xl text-sm transition transform hover:scale-[1.02] active:scale-[0.98] neon-btn-glow">
                    تسجيل الدخول
                </button>
            </div>
            
            @if (Route::has('register'))
                <div class="text-center pt-4 border-t border-gray-800/60 text-xs text-gray-500">
                    ليس لديك حساب حتى الآن؟ 
                    <a href="{{ route('register') }}" wire:navigate class="text-cyan-400 font-bold hover:underline ms-1">أنشئ حسابك الآن</a>
                </div>
            @endif
        </form>
    </div>
    
    <!-- وهج خلفي إضافي مخصص للكارد -->
    <div class="absolute w-72 h-72 bg-gradient-to-tr from-cyan-500/10 to-purple-500/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
</div>