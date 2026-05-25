<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<div class="flex items-center gap-4">
    <div x-data="{ open: false }" @click.away="open = false" class="relative">
        
        <button @click="open = !open" 
                class="inline-flex items-center gap-2 px-3 py-1.5 border border-gray-800 rounded-xl text-sm font-semibold text-gray-300 bg-[#111322]/60 hover:bg-[#161930] hover:text-white hover:border-cyan-500/30 focus:outline-none transition-all duration-200">
            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name" class="max-w-[100px] truncate"></div>

            <div class="text-gray-500">
                <svg class="fill-current h-4 w-4 transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="absolute left-0 mt-2 w-48 rounded-xl bg-[#111322] border border-cyan-500/20 shadow-2xl overflow-hidden z-50 pointer-events-auto"
             style="display: none;">
            
            <a href="{{ route('profile') }}" wire:navigate class="block w-full text-right px-4 py-2.5 text-xs font-bold text-gray-400 hover:text-white hover:bg-cyan-500/10 transition-colors">
                {{ __('الملف الشخصي') }}
            </a>

            <div class="border-t border-gray-800/60"></div>

            <button wire:click="logout" class="w-full text-right block px-4 py-2.5 text-xs font-bold text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition-colors">
                {{ __('تسجيل الخروج') }}
            </button>
            
        </div>
    </div>
</div>