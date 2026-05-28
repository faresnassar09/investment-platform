<?php

use App\Models\User\Investment\Investment;
use App\Models\User\Wallet\UserWallet;
use App\Repository\Contract\InvestmentInterface;
use App\Repository\Contract\PlanInterface;
use App\Repository\Contract\UserWalletInterface;
use App\Services\Logging\LoggingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Livewire\Volt\{state, computed};
use function Livewire\Volt\layout;

layout('layouts.app');

state(['selectedWallet' => [], 'userId' => Auth::id()]);



$userWallet = computed(function () {
    return app(UserWalletInterface::class)->find($this->userId);
});


$plans = computed(function () {
    return app(PlanInterface::class)->get();
});


$subscribeToPlan = function ($planId) {

    $walletType = $this->selectedWallet[$planId] ?? null;
    
    if (!$walletType || !in_array($walletType, ['balance', 'team_earnings', 'salary'])) {
        session()->flash('failed', 'يرجى تحديد حساب الدفع أولاً من القائمة المنسدلة قبل التفعيل.');
        return;
    }

    try {

        $plan = app(PlanInterface::class)->find($planId);

        $wallet = app(UserWalletInterface::class)->find($this->userId);

        if (!$wallet) {
            session()->flash('failed', 'لم يتم العثور على محفظة نشطة لحسابك.');
            return;
        }


        if ($wallet->$walletType < $plan->price) {
            $accountNames = [
                'balance' => 'الرصيد الأساسي',
                'team_earnings' => 'أرباح الفريق',
                'salary' => 'الراتب'
            ];
            session()->flash('failed', "عذراً، رصيد حساب ({$accountNames[$walletType]}) غير كافٍ لتفعيل هذه الخطة.");
            return;
        }


        DB::transaction(function () use ($wallet, $walletType, $plan) {

            $activeWallet = app(UserWalletInterface::class)->findAndLock($wallet->id);
            
            app(InvestmentInterface::class)->create($this->userId,$plan->id,$plan->price,$plan->duration_days);

            $activeWallet->decrement($walletType, $plan->price);



        });


        $this->selectedWallet[$planId] = '';

        session()->flash('success', 'تم تفعيل خطة ' . $plan->name . ' بنجاح! تم الخصم وبدأ استثمارك الآن.');
    } catch (\Exception $e) {

        app(LoggingService::class)->failedLogger('failed to apply investment',[],$e->getMessage());
        session()->flash('failed', 'عذراً، تعذر تفعيل الخطة حالياً. يرجى المحاولة مرة أخرى.');
    }
};

?>

<div class="space-y-8" dir="rtl">
    
    {{-- هيدر الصفحة الرئيسي --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-2.5">
                الخطط الاستثمارية <span class="text-xs font-mono font-bold bg-purple-500/10 text-purple-400 px-3 py-1 rounded-full border border-purple-500/20">فرص حصرية</span>
            </h1>
            <p class="text-sm text-gray-400 mt-1.5">اختر الخطة التي تناسب أهدافك المالية وابدأ في تنمية رأس مالك الرقمي اليوم.</p>
        </div>
    </div>

    {{-- لوحة الأرصدة العلوية الأنيقة (Widgets) --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        {{-- كارت الرصيد الأساسي --}}
        <div class="bg-[#161930]/40 backdrop-blur-md border border-gray-800/60 rounded-2xl p-4 flex items-center justify-between shadow-md">
            <div class="space-y-1">
                <span class="text-[11px] text-gray-400 font-bold block">الرصيد الأساسي</span>
                <span class="text-xl font-black text-white font-mono tracking-tight">
                    {{ number_format($this->userWallet->balance ?? 0, 2) }}
                </span>
            </div>
            <div class="p-2.5 bg-emerald-500/10 text-emerald-400 rounded-xl border border-emerald-500/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
        </div>

        {{-- كارت أرباح الفريق --}}
        <div class="bg-[#161930]/40 backdrop-blur-md border border-gray-800/60 rounded-2xl p-4 flex items-center justify-between shadow-md">
            <div class="space-y-1">
                <span class="text-[11px] text-gray-400 font-bold block">أرباح الفريق</span>
                <span class="text-xl font-black text-cyan-400 font-mono tracking-tight">
                    {{ number_format($this->userWallet->team_earnings ?? 0, 2) }}
                </span>
            </div>
            <div class="p-2.5 bg-cyan-500/10 text-cyan-400 rounded-xl border border-cyan-500/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>

        {{-- كارت حساب الراتب --}}
        <div class="bg-[#161930]/40 backdrop-blur-md border border-gray-800/60 rounded-2xl p-4 flex items-center justify-between shadow-md">
            <div class="space-y-1">
                <span class="text-[11px] text-gray-400 font-bold block">حساب الراتب</span>
                <span class="text-xl font-black text-purple-400 font-mono tracking-tight">
                    {{ number_format($this->userWallet->salary ?? 0, 2) }}
                </span>
            </div>
            <div class="p-2.5 bg-purple-500/10 text-purple-400 rounded-xl border border-purple-500/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- رسائل التنبيه والـ Flash Sessions --}}
    @if (session()->has('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('failed'))
        <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-sm font-bold">
            {{ session('failed') }}
        </div>
    @endif

    {{-- شبكة عرض الخطط الاستثمارية --}}
    @if($this->plans->isEmpty())
        <div class="p-16 text-center bg-[#111322]/40 backdrop-blur-md border border-gray-850 rounded-2xl space-y-3">
            <svg class="w-12 h-12 text-gray-700 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <p class="text-sm text-gray-500">لا توجد خطط استثمارية متاحة في الوقت الحالي.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($this->plans as $plan)
                <div class="relative bg-gradient-to-b from-[#161930]/70 to-[#111322]/90 backdrop-blur-md border border-gray-800/60 rounded-2xl p-6 flex flex-col justify-between transition-all duration-300 hover:border-cyan-500/40 hover:shadow-lg hover:shadow-cyan-500/5 group">
                    
                    <div class="absolute top-3 left-4">
                        <span class="text-[10px] font-mono font-bold tracking-wider bg-gray-800 text-gray-400 px-2.5 py-0.5 rounded border border-gray-750 uppercase">
                            ID: {{ $plan->id }}
                        </span>
                    </div>

                    <div class="space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-cyan-500/10 text-cyan-400 rounded-xl border border-cyan-500/10 group-hover:bg-cyan-400 group-hover:text-slate-950 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-black text-white group-hover:text-cyan-400 transition-colors duration-300">
                                {{ $plan->name }}
                            </h3>
                        </div>

                        <div class="bg-[#111322]/50 border border-gray-850/40 rounded-xl p-4 flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-bold">تكلفة الخطة</span>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-2xl font-black text-white font-mono tracking-tight">
                                    {{ number_format($plan->price, 0) }}
                                </span>
                                <span class="text-xs font-bold text-cyan-400 font-mono uppercase">
                                    {{ $plan->currency ?? 'USD' }}
                                </span>
                            </div>
                        </div>

                        <div class="text-sm text-gray-200 leading-relaxed min-h-[100px] px-1 whitespace-pre-line space-y-2.5">
                            @if($plan->description)
                                {!! border_bullet_list($plan->description) .
                                    border_bullet_list( 'عدد ايام الصلاحية'. ' '. $plan->duration_days . ' يوم ') !!}

                            @else
                                <span class="text-gray-600 italic">لا يوجد وصف متاح لهذه الخطة حالياً.</span>
                            @endif
                        </div>
                    </div>

                    {{-- إضافة حقل قائمة خيارات الدفع والزر مدمجين بأسفل الكارت --}}
                    <div class="pt-5 mt-4 border-t border-gray-850/30 space-y-3">
                        
                        <div>
                            <label class="text-[11px] text-gray-500 font-bold block mb-1.5 mr-1">حساب الدفع المستخدم</label>
                            <select wire:model="selectedWallet.{{ $plan->id }}" 
                                    class="w-full bg-[#111322]/80 border border-gray-850 hover:border-gray-750 text-gray-300 text-xs rounded-xl px-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-cyan-500/40 transition-all cursor-pointer font-sans">
                                <option value="">-- اختر من أي حساب تود الاستثمار --</option>
                                <option value="balance">الرصيد الأساسي ({{ number_format($this->userWallet->balance ?? 0, 1) }})</option>
                                <option value="team_earnings">أرباح الفريق ({{ number_format($this->userWallet->team_earnings ?? 0, 1) }})</option>
                                <option value="salary">حساب الراتب ({{ number_format($this->userWallet->salary ?? 0, 1) }})</option>
                            </select>
                        </div>

                        <button type="button" 
                                wire:click="subscribeToPlan({{ $plan->id }})"
                                wire:confirm="هل أنت متأكد من رغبتك في تفعيل الخطة الاستثمارية خصماً من الحساب المحدد؟"
                                class="w-full bg-[#161930]/90 hover:bg-cyan-400 border border-gray-800 hover:border-cyan-400 text-gray-200 hover:text-slate-950 font-bold text-xs py-3 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-sm">
                            <span>تفعيل الخطة الآن</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-[-1px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

<?php
function border_bullet_list($text) {
    $lines = explode("\n", str_replace("\r", "", $text));
    $output = '';
    
    foreach ($lines as $line) {
        $trimmed = trim($line);
        if (empty($trimmed)) continue;
        
        $cleanedLine = ltrim($trimmed, '.•- ');
        
        $output .= '<div class="flex items-start gap-2.5 mb-1.5">';
        $output .= '<span class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2.5 shrink-0 shadow-sm shadow-cyan-400"></span>';
        $output .= '<span>' . e($cleanedLine) . '</span>';
        $output .= '</div>';
    }
    
    return $output;
}
?>