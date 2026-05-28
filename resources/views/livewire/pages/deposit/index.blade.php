<?php

use App\Models\User\Deposit\Deposit;
use App\Repository\Contract\DepositInterface;
use App\Services\Files\FileService;
use App\Services\Logging\LoggingService;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\{state, usesFileUploads, computed};
use function Livewire\Volt\layout;

usesFileUploads();
layout('layouts.app');

state([
    'paymentMethod' => 'usdt',
    'amount' => '',
    'transactionImage' => null,
    'cryptoAddresses' => [
        'usdt' => 'TYuR927xksM910HsnvKqwPzLq192KskWpQ',
        'tron' => 'TLx8192shPqMnVzKqwpPzLq192KskWpQaa'
    ]
]);


$deposits = computed(function () {
    return app(DepositInterface::class)->get() ;
});


$selectMethod = function ($method) {
    $this->paymentMethod = $method;
    $this->resetErrorBag();
};

$submitDeposit = function () {
    $this->validate([
        'amount' => 'required|numeric|min:10',
        'transactionImage' => 'required|image|max:2048',
    ]);

    try {
        $imagePath = app(FileService::class)->uploadImage($this->transactionImage, 'deposits');

        app(DepositInterface::class)->create(Auth::id(), $this->amount, 'إيداع للمحفظة', $imagePath);

        session()->flash('success', 'تم إرسال طلب الإيداع بنجاح، جاري مراجعة التحويل من قبل الإدارة.');
        
        $this->reset(['amount', 'transactionImage']);     

    } catch (\Exception $e) {
        session()->flash('failed', 'فشل إرسال طلب الإيداع، رجاءً حاول مرة أخرى أو تواصل مع الإدارة.');
        app(LoggingService::class)->failedLogger('failed to complete the deposit request', [], $e->getMessage());
    }
};

$deleteDeposit = function ($id) {
    try {

       $status = app(DepositInterface::class)->delete($id);

        throw_if(!$status,'no deposit to delete');
       
        session()->flash('success', 'تم حذف طلب الإيداع بنجاح.');
    } catch (\Exception $e) {
        session()->flash('failed', 'لا يمكن حذف هذا الطلب حالياً.');
    }
};

?>

<div class="space-y-8" dir="rtl">
    
    <div>
        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
            شحن المحفظة <span class="text-xs font-mono font-bold bg-cyan-500/10 text-cyan-400 px-2.5 py-0.5 rounded-full border border-cyan-500/20">إيداع آمن</span>
        </h1>
        <p class="text-xs text-gray-500 mt-1">اختر وسيلة الدفع المناسبة لإرسال العملات الرقمية وتفعيل خطتك الاستثمارية.</p>
    </div>

    @if (session()->has('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('failed'))
        <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs font-bold">
            {{ session('failed') }}
        </div>
    @endif

    <div class="p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl space-y-4">
        <h3 class="text-xs font-bold text-gray-400 tracking-wider">1. اختر طريقة الدفع</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <button type="button" wire:click="selectMethod('usdt')"
                class="p-4 rounded-xl border text-right transition relative overflow-hidden group {{ $paymentMethod === 'usdt' ? 'bg-[#161930]/60 border-cyan-500/40' : 'bg-[#111322]/40 border-gray-850 hover:border-gray-800' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-500/10 text-emerald-400 rounded-lg border border-emerald-500/20 font-mono font-black text-xs">USDT</div>
                        <div>
                            <h4 class="text-xs font-bold text-white">دولار رقمي (USDT)</h4>
                            <p class="text-[10px] text-gray-500 mt-0.5">شبكة TRC-20 الفورية</p>
                        </div>
                    </div>
                    <div class="w-4 h-4 rounded-full border flex items-center justify-center {{ $paymentMethod === 'usdt' ? 'border-cyan-400 bg-cyan-400/20' : 'border-gray-750' }}">
                        @if($paymentMethod === 'usdt') <div class="w-1.5 h-1.5 rounded-full bg-cyan-400"></div> @endif
                    </div>
                </div>
            </button>
        </div>
    </div>

    <div class="p-6 bg-[#111322]/80 backdrop-blur-md border-2 border-cyan-500/30 rounded-2xl text-center space-y-4 shadow-xl shadow-cyan-500/5">
        <div>
            <span class="text-[10px] font-mono font-bold bg-cyan-500/10 text-cyan-400 px-3 py-1 rounded-full border border-cyan-500/20 uppercase">
                عنوان استقبال عملة {{ $paymentMethod }} الحالي
            </span>
            <p class="text-xs text-gray-400 mt-2">انسخ العنوان الموضح أدناه بعناية وقم بتحويل القيمة من محفظتك الخاصة.</p>
        </div>

        <div x-data="{ copied: false }" class="max-w-2xl mx-auto">
            <div class="relative flex items-center bg-[#161930]/80 border border-gray-800 rounded-xl overflow-hidden p-1">
                <input type="text" value="{{ $cryptoAddresses[$paymentMethod] ?? '' }}" readonly id="crypto-addr"
                       class="w-full bg-transparent py-3.5 px-4 text-center text-sm md:text-base font-mono text-cyan-300 font-bold tracking-wider focus:outline-none select-all" />
                
                <button @click="navigator.clipboard.writeText(document.getElementById('crypto-addr').value); copied = true; setTimeout(() => copied = false, 2000)" 
                        type="button"
                        class="absolute left-2 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-black px-4 py-2.5 rounded-lg text-xs transition focus:outline-none shadow-md">
                    <span x-show="!copied">نسخ العنوان</span>
                    <span x-show="copied" style="display: none;">تم النسخ!</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <form wire:submit.prevent="submitDeposit" class="p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl space-y-5">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">3. بيانات التأكيد</h3>
            
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-400">المبلغ المرسل ($)</label>
                    <div class="relative flex items-center">
                        <input type="number" wire:model="amount" step="any" placeholder="0.00"
                            class="w-full bg-[#161930]/40 border border-gray-850 rounded-xl px-4 py-3 text-xs font-mono text-white placeholder-gray-600 focus:outline-none focus:border-cyan-500/40 transition" />
                        <span class="absolute left-4 font-mono text-[10px] font-bold text-gray-500 uppercase">USD</span>
                    </div>
                    @error('amount') <span class="text-[10px] text-red-400 font-bold block mt-0.5">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-gray-400">إثبات التحويل (صورة اللقطة)</label>
                    <div class="relative flex items-center">
                        <input type="file" wire:model="transactionImage" id="tx-file" class="hidden" accept="image/*" />
                        <label for="tx-file" class="w-full bg-[#161930]/40 border border-gray-850 rounded-xl px-4 py-3 text-xs text-gray-400 cursor-pointer hover:bg-[#161930]/60 transition flex items-center justify-between overflow-hidden whitespace-nowrap">
                            <span class="truncate max-w-[250px]">
                                @if ($transactionImage) 
                                    {{ $transactionImage->getClientOriginalName() }} 
                                @else 
                                    اختر صورة الإيصال... 
                                @endif
                            </span>
                            <svg class="w-4 h-4 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </label>
                    </div>
                    @error('transactionImage') <span class="text-[10px] text-red-400 font-bold block mt-0.5">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-cyan-400 disabled:opacity-50 text-slate-950 font-black text-xs py-3 rounded-xl shadow-lg shadow-cyan-400/10 transition transform hover:scale-[1.01] flex items-center justify-center gap-2">
                    <span wire:loading.remove>تأكيد الإيداع وإرسال الطلب</span>
                    <span wire:loading>جاري معالجة الملفات...</span>
                </button>
            </div>
        </form>

        <div class="p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between">
            <div class="space-y-3">
                <h4 class="text-xs font-bold text-white flex items-center gap-1.5 border-b border-gray-850/60 pb-3 uppercase tracking-wider">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    تعليمات الإرسال الصحيح لنظام البلوكشين:
                </h4>
                
                <ul class="text-[11px] text-gray-400 space-y-2.5 list-disc list-inside pr-1 leading-relaxed">
                    @if($paymentMethod === 'usdt')
                        <li>تأكد تماماً من اختيار شبكة <span class="text-white font-bold font-mono">TRC-20</span> عند السحب من منصتك.</li>
                        <li>أي إرسال لعملات غير <span class="text-emerald-400 font-bold font-mono">USDT</span> للعنوان المذكور سيؤدي لخسارة أموالك بشكل دائم.</li>
                        <li>يرجى مراعاة رسوم اقتطاع الشبكة الخاصة بمنصتك (تأكد أن يصل المبلغ الصافي مطابقاً لما تكتَبه).</li>
                    @else
                        <li>تأكد من إرسال عملة ترون <span class="text-white font-bold font-mono">TRX</span> فقط للعنوان المذكور أعلاه.</li>
                        <li>يرجى الانتظار حتى اكتمال 3 تأكيدات على البلوكشين قبل رفع الصورة.</li>
                        <li>يتم احتساب قيمة الـ <span class="text-red-400 font-bold font-mono">TRX</span> تلقائياً بالسعر اللحظي للسوق فور وصول المعاملة.</li>
                    @endif
                    <li>يجب أن تكون صورة التحويل واضحة وتظهر كود العملية <span class="text-white font-mono font-bold">(TXID/Hash)</span> بالكامل.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="p-6 bg-[#111322]/40 backdrop-blur-md border border-gray-850 rounded-2xl space-y-4">
        <div class="flex items-center justify-between border-b border-gray-850/60 pb-3">
            <div>
                <h3 class="text-xs font-bold text-white uppercase tracking-wider">سجل عمليات الإيداع</h3>
                <p class="text-[10px] text-gray-500 mt-0.5">قائمة بجميع الطلبات السابقة وحالتها في النظام.</p>
            </div>
            <span class="text-[10px] font-mono font-bold bg-gray-800 text-gray-400 px-2.5 py-1 rounded-lg">
                إجمالي العمليات: {{ $this->deposits->count() }}
            </span>
        </div>

        @if($this->deposits->isEmpty())
            <div class="text-center py-8 space-y-2">
                <svg class="w-8 h-8 text-gray-700 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                <p class="text-xs text-gray-500">لا توجد أي عمليات إيداع مسجلة حتى الآن.</p>
            </div>
        @else
            <div class="overflow-x-auto rounded-xl border border-gray-850/40">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-[#161930]/40 border-b border-gray-850 text-gray-400 text-[11px] font-bold">
                            <th class="p-4">المبلغ ($)</th>
                            <th class="p-4">البيان</th>
                            <th class="p-4 text-center">الإيصال</th>
                            <th class="p-4 text-center">الحالة</th>
                            <th class="p-4 text-center">التاريخ</th>
                            <th class="p-4 text-left">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-850/40 text-xs text-gray-300 font-medium">
                        @foreach($this->deposits as $deposit)
                            <tr class="hover:bg-[#161930]/20 transition-colors">
                                <td class="p-4 font-mono font-bold text-white text-sm">
                                    ${{ number_format($deposit->amount, 2) }}
                                </td>
                                <td class="p-4 text-gray-400 text-[11px]">
                                    {{ $deposit->description ?? 'إيداع محفظة' }}
                                </td>
                                <td class="p-4 text-center">
                                    @if($deposit->image_path)
                                        <a href="{{ asset('storage/' . $deposit->image_path) }}" target="_blank" 
                                           class="inline-flex items-center gap-1 text-[10px] font-bold text-cyan-400 hover:text-cyan-300 bg-cyan-500/5 hover:bg-cyan-500/10 border border-cyan-500/10 px-2 py-1 rounded-md transition">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            عرض المستند
                                        </a>
                                    @else
                                        <span class="text-gray-600 text-[10px]">لا يوجد</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if($deposit->status === 'accepted')
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">مقبول</span>
                                    @elseif($deposit->status === 'pending')
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">قيد الانتظار</span>
                                    @elseif($deposit->status === 'rejected')
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20">مرفوض</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center font-mono text-[10px] text-gray-500">
                                    {{ $deposit->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="p-4 text-left">
                                    @if($deposit->status === 'pending')
                                        <button type="button" 
                                                wire:click="deleteDeposit({{ $deposit->id }})" 
                                                wire:confirm="هل أنت متأكد من إلغاء وحذف هذا الطلب؟"
                                                class="inline-flex items-center justify-center p-1.5 rounded-lg bg-red-500/5 hover:bg-red-500/10 border border-red-500/10 text-red-400 hover:text-red-300 transition group">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    @else
                                        <span class="text-gray-600 text-[11px] px-2">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>