<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support5\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'current_password' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'current_password' => ['required', 'string', 'current_password'],
    'password' => ['required', 'string', Password::defaults(), 'confirmed'],
]);

$updatePassword = function () {
    try {
        $validated = $this->validate();
    } catch (ValidationException $e) {
        $this->reset('current_password', 'password', 'password_confirmation');

        throw $e;
    }

    Auth::user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    $this->reset('current_password', 'password', 'password_confirmation');

    $this->dispatch('password-updated');
};

?>

<section class="space-y-6">
    <header>
        <h2 class="text-md font-bold text-white">
            تحديث كلمة المرور
        </h2>
        <p class="mt-1 text-xs text-gray-400">
            تأكد من استخدام كلمة مرور طويلة وعشوائية للحفاظ على أمان حسابك الاستثماري.
        </p>
    </header>

    <form wire:submit="updatePassword" class="space-y-4">
        <div>
            <label for="update_password_current_password" class="block text-xs font-bold text-gray-400 mb-1.5">كلمة المرور الحالية</label>
            <input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" 
                   class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" 
                   autocomplete="current-password" placeholder="••••••••" />
            @if($errors->has('current_password'))
                <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('current_password') }}</span>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold text-gray-400 mb-1.5">كلمة المرور الجديدة</label>
            <input wire:model="password" id="update_password_password" name="password" type="password" 
                   class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" 
                   autocomplete="new-password" placeholder="••••••••" />
            @if($errors->has('password'))
                <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-gray-400 mb-1.5">تأكيد كلمة المرور الجديدة</label>
            <input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" 
                   autocomplete="new-password" placeholder="••••••••" />
            @if($errors->has('password_confirmation'))
                <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" 
                    class="bg-cyan-400 text-slate-950 font-black px-6 py-2.5 rounded-xl text-xs transition transform hover:scale-[1.02] active:scale-[0.98]">
                حفظ التغييرات
            </button>

            <div x-data="{ show: false }" 
                 x-on:password-updated.window="show = true; setTimeout(() => show = false, 2000)" 
                 x-show="show" 
                 x-transition
                 style="display: none;" 
                 class="text-xs font-bold text-emerald-400 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                تم التحديث بنجاح.
            </div>
        </div>
    </form>
</section>