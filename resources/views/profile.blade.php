<x-app-layout>
    <div class="mb-8" dir="rtl">
        <h1 class="text-xl font-black text-white tracking-tight">إعدادات الحساب</h1>
        <p class="text-xs text-gray-500 mt-1">قم بإدارة بياناتك الشخصية، تأمين حسابك، أو التحكم في صلاحيات العضوية</p>
    </div>

    <div class="space-y-6 max-w-4xl" dir="rtl">
        
        <div class="p-6 sm:p-8 bg-[#111322]/60 backdrop-blur-md rounded-2xl border border-gray-850 shadow-2xl neon-card">
            <div class="max-w-xl text-gray-200">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-[#111322]/60 backdrop-blur-md rounded-2xl border border-gray-850 shadow-2xl neon-card">
            <div class="max-w-xl text-gray-200">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-[#111322]/40 backdrop-blur-md rounded-2xl border border-rose-500/10 shadow-2xl">
            <div class="max-w-xl text-gray-200">
                <livewire:profile.delete-user-form />
            </div>
        </div>
        
    </div>
</x-app-layout>