<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;

state([
    'name' => fn () => auth()->user()->name,
    'email' => fn () => auth()->user()->email
]);

$updateProfileInformation = function () {
    $user = Auth::user();

    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
    ]);

    $user->fill($validated);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    $this->dispatch('profile-updated', name: $user->name);
};

$sendVerification = function () {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false));

        return;
    }

    $user->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

?>

<section class="space-y-6">
    <header>
        <h2 class="text-md font-bold text-white">
            البيانات الشخصية
        </h2>

        <p class="mt-1 text-xs text-gray-400">
            تحديث بيانات حسابك الاستثماري والبريد الإلكتروني المسجل.
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="space-y-4">
        <div>
            <label for="name" class="block text-xs font-bold text-gray-400 mb-1.5">الاسم</label>
            <input wire:model="name" id="name" name="name" type="text" 
                   class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" 
                   required autofocus autocomplete="name" />
            @if($errors->has('name'))
                <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-gray-400 mb-1.5">البريد الإلكتروني</label>
            <input wire:model="email" id="email" name="email" type="email" 
                   class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" 
                   required autocomplete="username" />
            @if($errors->has('email'))
                <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('email') }}</span>
            @endif

            @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-xl bg-amber-500/5 border border-amber-500/10">
                    <p class="text-xs text-amber-400 flex items-center gap-2 flex-wrap">
                        <span>بريدك الإلكتروني غير مفعّل حتى الآن.</span>

                        <button wire:click.prevent="sendVerification" class="underline font-bold text-cyan-400 hover:text-cyan-300 focus:outline-none">
                            اضغط هنا لإعادة إرسال رابط التفعيل.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-emerald-400">
                            تم إرسال رابط تفعيل جديد إلى عنوان بريدك الإلكتروني.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" 
                    class="bg-cyan-400 text-slate-950 font-black px-6 py-2.5 rounded-xl text-xs transition transform hover:scale-[1.02] active:scale-[0.98]">
                حفظ التغييرات
            </button>

            <div x-data="{ show: false }" 
                 x-on:profile-updated.window="show = true; setTimeout(() => show = false, 2000)" 
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