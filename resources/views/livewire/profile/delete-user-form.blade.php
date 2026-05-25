<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state(['password' => '']);

rules(['password' => ['required', 'string', 'current_password']]);

$deleteUser = function (Logout $logout) {
    $this->validate();

    tap(Auth::user(), $logout(...))->delete();

    $this->redirect('/', navigate: true);
};

?>

<section class="space-y-6" x-data="{ openModal: false }" @open-modal.window="if ($event.detail === 'confirm-user-deletion') openModal = true" @close.window="openModal = false">
    <header>
        <h2 class="text-md font-bold text-rose-400">
            حذف الحساب الاستثماري
        </h2>

        <p class="mt-1 text-xs text-gray-400">
            بمجرد حذف حسابك، سيتم تدمير جميع بياناتك ومواردك الاستثمارية نهائياً. قبل التأكيد، يرجى سحب أي أرصدة معلقة أو حفظ بياناتك الخاصة.
        </p>
    </header>

    <button type="button"
            @click="openModal = true"
            class="bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-600 hover:text-white font-bold px-6 py-2.5 rounded-xl text-xs transition transform hover:scale-[1.02] active:scale-[0.98]">
        إغلاق وتدمير الحساب
    </button>

    <div x-show="openModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto" 
         style="display: none;">
        
        <div class="fixed inset-0 bg-[#07080f]/80 backdrop-blur-md transition-opacity" @click="openModal = false"></div>

        <div x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-[#0b0c16] border border-rose-500/20 max-w-lg w-full rounded-2xl p-6 shadow-2xl z-10 overflow-hidden">
            
            <form wire:submit="deleteUser" class="space-y-4">

                <div>
                    <h3 class="text-md font-bold text-white">
                        هل أنت متأكد تماماً من رغبتك في حذف الحساب؟
                    </h3>

                    <p class="mt-1 text-xs text-gray-400">
                        الرجاء إدخال كلمة المرور الحالية لتأكيد هويتك وسلطتك في تنفيذ إجراء تدمير الحساب نهائياً.
                    </p>
                </div>

                <div>
                    <label for="password" class="sr-only">كلمة المرور</label>
                    <input wire:model="password"
                           id="password"
                           name="password"
                           type="password"
                           class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition"
                           placeholder="أدخل كلمة المرور لتأكيد الحذف" />

                    @if($errors->has('password'))
                        <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" 
                            @click="openModal = false" 
                            class="bg-[#111322] border border-gray-800 text-gray-400 hover:text-white font-bold px-5 py-2 rounded-xl text-xs transition">
                        تراجع
                    </button>

                    <button type="submit" 
                            class="bg-rose-600 text-white font-bold px-5 py-2 rounded-xl text-xs hover:bg-rose-500 shadow-lg shadow-rose-600/20 transition">
                        تأكيد الحذف النهائي
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>