<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('user.dashboard', absolute: false), navigate: true);
};

?>

<div class="min-h-screen flex flex-col justify-center items-center px-6 relative z-10" dir="rtl">
    
    <!-- الكارد الرئيسي لنموذج إنشاء الحساب بتأثير الزجاج الخلفي المتوهج -->
    <div class="w-full max-w-md bg-[#111322]/80 backdrop-blur-md p-8 rounded-3xl border border-purple-500/20 shadow-2xl neon-card">
        
        <!-- شعار المنصة في أعلى الفورم -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-3 justify-center mb-2">
                <div class="bg-gradient-to-tr from-emerald-500 to-cyan-500 p-2 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h1 class="text-white font-black text-xl tracking-tight">Investment <span class="text-cyan-400">Hub</span></h1>
            </div>
            <p class="text-xs text-gray-400">أنشئ حسابك الاستثماري الجديد مجاناً وابدأ رحلتك</p>
        </div>

        <form wire:submit="register" class="space-y-4">
            
            <!-- الاسم الكامل -->
            <div>
                <label for="name" class="block text-xs font-bold text-gray-400 mb-1.5">الاسم الكامل</label>
                <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                       class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                       placeholder="مثال: أحمد محمد">
                @if($errors->has('name'))
                    <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <!-- البريد الإلكتروني -->
            <div>
                <label for="email" class="block text-xs font-bold text-gray-400 mb-1.5">البريد الإلكتروني</label>
                <input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                       class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                       placeholder="name@example.com">
                @if($errors->has('email'))
                    <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <!-- كلمة المرور -->
            <div>
                <label for="password" class="block text-xs font-bold text-gray-400 mb-1.5">كلمة المرور</label>
                <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                       placeholder="••••••••">
                @if($errors->has('password'))
                    <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <!-- تأكيد كلمة المرور -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-gray-400 mb-1.5">تأكيد كلمة المرور</label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"
                       placeholder="••••••••">
                @if($errors->has('password_confirmation'))
                    <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <!-- زر التسجيل المتوهج -->
            <div class="pt-3">
                <button type="submit" 
                        class="w-full bg-cyan-400 text-slate-950 font-black py-3 rounded-xl text-sm transition transform hover:scale-[1.02] active:scale-[0.98] neon-btn-glow">
                    إنشاء الحساب
                </button>
            </div>
            
            <!-- العودة لصفحة تسجيل الدخول -->
            <div class="text-center pt-4 border-t border-gray-800/60 text-xs text-gray-500">
                لديك حساب بالفعل؟ 
                <a href="{{ route('login') }}" wire:navigate class="text-cyan-400 font-bold hover:underline ms-1">تسجيل الدخول</a>
            </div>
        </form>
    </div>
    
    <!-- وهج سديمي إضافي مخصص خلف كارد التسجيل -->
    <div class="absolute w-72 h-72 bg-gradient-to-tr from-purple-500/10 to-cyan-500/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
</div>