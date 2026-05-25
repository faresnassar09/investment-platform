<?php

use function Livewire\Volt\{state, usesFileUploads};

usesFileUploads();

use function Livewire\Volt\layout;

layout('layouts.app');

?>

    <div class="space-y-6" dir="rtl">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                    المحفظة الاستثمارية <span class="text-xs font-mono font-bold bg-cyan-500/10 text-cyan-400 px-2.5 py-0.5 rounded-full border border-cyan-500/20">حساب نشط</span>
                </h1>
                <p class="text-xs text-gray-500 mt-1">تابع نمو خططك الاستثمارية، رتبتك الحالية، وعوائد الفريق في الوقت الفعلي.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="bg-[#111322]/80 hover:bg-[#161930] border border-gray-800 text-gray-300 font-bold text-xs px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    شحن الرصيد (إيداع)
                </button>
                <button class="bg-cyan-400 text-slate-950 font-black text-xs px-4 py-2.5 rounded-xl shadow-lg shadow-cyan-400/10 transition transform hover:scale-[1.02]">
                    شراء خطة استثمارية
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="p-5 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between min-h-[125px]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">الرصيد المتاح للسحب</p>
                        <h3 class="text-xl font-black text-white font-mono mt-1.5">$3,450.00</h3>
                    </div>
                    <div class="p-2.5 bg-cyan-500/10 text-cyan-400 rounded-xl border border-cyan-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 text-[11px] mt-4">
                    <span class="text-gray-400 font-bold">الخطط النشطة حالياً:</span>
                    <span class="text-cyan-400 font-mono font-bold">3 خطط</span>
                </div>
            </div>

            <div class="p-5 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between min-h-[125px]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">رأس المال المستثمر</p>
                        <h3 class="text-xl font-black text-white font-mono mt-1.5">$12,000.00</h3>
                    </div>
                    <div class="p-2.5 bg-purple-500/10 text-purple-400 rounded-xl border border-purple-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 text-[11px] mt-4">
                    <span class="text-emerald-400 font-bold font-mono">+$84.20</span>
                    <span class="text-gray-600">أرباح اليوم التلقائية</span>
                </div>
            </div>

            <div class="p-5 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between min-h-[125px]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">أرباح الإحالات والفريق</p>
                        <h3 class="text-xl font-black text-emerald-400 font-mono mt-1.5">$1,840.50</h3>
                    </div>
                    <div class="p-2.5 bg-emerald-500/10 text-emerald-400 rounded-xl border border-emerald-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 text-[11px] mt-4">
                    <span class="text-gray-400">إجمالي المدعوين:</span>
                    <span class="text-white font-mono font-bold">42 مستخدم</span>
                </div>
            </div>

            <div class="p-5 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between min-h-[125px]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">الراتب الشهري الثابت</p>
                        <h3 class="text-xl font-black text-amber-400 font-mono mt-1.5">$500.00 / شهر</h3>
                    </div>
                    <div class="p-2.5 bg-amber-500/10 text-amber-400 rounded-xl border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 text-[11px] mt-4">
                    <span class="text-gray-400">تاريخ الصرف القادم:</span>
                    <span class="text-amber-400 font-mono font-bold">بعد 8 أيام</span>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl space-y-6">
                <div class="border-b border-gray-850/60 pb-4">
                    <h2 class="text-sm font-bold text-white">خططك الاستثمارية النشطة</h2>
                    <p class="text-[11px] text-gray-500 mt-0.5">متابعة أداء وعوائد الباقات والخطط التي قمت بشرائها.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="p-4 bg-[#161930]/40 border border-cyan-500/10 rounded-xl space-y-3 relative overflow-hidden">
                        <div class="absolute top-0 left-0 bg-cyan-500/10 text-cyan-400 font-mono text-[9px] font-bold px-2 py-0.5 rounded-br-xl border-r border-b border-cyan-500/10">PLAN-VIP</div>
                        <div>
                            <h4 class="text-xs font-bold text-white">خطة النيون المتقدمة</h4>
                            <p class="text-[10px] text-gray-500 mt-0.5">قيمة الخطة: <span class="text-white font-mono">$5,000</span></p>
                        </div>
                        <div class="space-y-1">
                            <div class="flex justify-between text-[10px]">
                                <span class="text-gray-400">العائد المحقق حتى الآن</span>
                                <span class="text-emerald-400 font-mono font-bold">65% ($3,250)</span>
                            </div>
                            <div class="h-1.5 bg-[#111322] rounded-full overflow-hidden">
                                <div class="h-full bg-cyan-400" style="width: 65%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-[10px] text-gray-500 pt-1 border-t border-gray-850/40">
                            <span>العائد اليومي: <span class="text-emerald-400 font-mono">2.5%</span></span>
                            <span>ينتهي في: <span class="text-white font-mono">24 يوم</span></span>
                        </div>
                    </div>

                    <div class="p-4 bg-[#161930]/40 border border-purple-500/10 rounded-xl space-y-3 relative overflow-hidden">
                        <div class="absolute top-0 left-0 bg-purple-500/10 text-purple-400 font-mono text-[9px] font-bold px-2 py-0.5 rounded-br-xl border-r border-b border-purple-500/10">PLAN-BASIC</div>
                        <div>
                            <h4 class="text-xs font-bold text-white">خطة البداية الذكية</h4>
                            <p class="text-[10px] text-gray-500 mt-0.5">قيمة الخطة: <span class="text-white font-mono">$1,000</span></p>
                        </div>
                        <div class="space-y-1">
                            <div class="flex justify-between text-[10px]">
                                <span class="text-gray-400">العائد المحقق حتى الآن</span>
                                <span class="text-purple-400 font-mono font-bold">90% ($90)</span>
                            </div>
                            <div class="h-1.5 bg-[#111322] rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-[10px] text-gray-500 pt-1 border-t border-gray-850/40">
                            <span>العائد اليوم; <span class="text-emerald-400 font-mono">1.8%</span></span>
                            <span>ينتهي في: <span class="text-white font-mono">3 أيام</span></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between">
                <div>
                    <div class="border-b border-gray-850/60 pb-4 mb-4">
                        <h2 class="text-sm font-bold text-white">مستوى الرتبة ونظام القادة</h2>
                        <p class="text-[11px] text-gray-500 mt-0.5">مؤشرات ترقية رتبتك وفتح رواتب شهرية أكبر.</p>
                    </div>

                    <div class="text-center py-3 bg-[#161930]/30 border border-gray-850 rounded-xl mb-4">
                        <p class="text-[10px] text-gray-500 font-bold uppercase">الرتبة الحالية</p>
                        <h3 class="text-md font-black text-amber-400 tracking-wide mt-1 flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            قائد برونزي (Silver Leader)
                        </h3>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-1.5">
                            <div class="flex justify-between text-[11px]">
                                <span class="text-gray-400">مبيعات الفريق المستهدفة</span>
                                <span class="text-white font-mono font-bold">$7,500 / $10,000</span>
                            </div>
                            <div class="h-1.5 bg-[#161930] rounded-full overflow-hidden">
                                <div class="h-full bg-amber-400 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex justify-between text-[11px]">
                                <span class="text-gray-400">عدد الإحالات النشطة المباشرة</span>
                                <span class="text-white font-mono font-bold">8 / 10 إحالات</span>
                            </div>
                            <div class="h-1.5 bg-[#161930] rounded-full overflow-hidden">
                                <div class="h-full bg-cyan-400 rounded-full" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-amber-500/5 border border-amber-500/10 rounded-xl text-[11px] text-gray-400">
                    عند الترقية للرتبة التالية <span class="text-white font-bold">Golden Leader</span> سيرتفع راتبك التلقائي إلى <span class="text-amber-400 font-bold">$1,200</span> شهرياً.
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-850/60 pb-4 mb-4">
                    <div>
                        <h2 class="text-sm font-bold text-white">سجل المعاملات المالية الأخير</h2>
                        <p class="text-[11px] text-gray-500 mt-0.5">بيان عمليات الإيداع، الأرباح اليومية، والرواتب المصروفة لحسابك.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right text-xs">
                        <thead>
                            <tr class="text-gray-500 border-b border-gray-850/40">
                                <th class="pb-3 font-bold">رقم العملية</th>
                                <th class="pb-3 font-bold">نوع المعاملة</th>
                                <th class="pb-3 font-bold">التاريخ والتوقيت</th>
                                <th class="pb-3 font-bold text-left">المبلغ</th>
                                <th class="pb-3 font-bold text-center">الحالة</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-850/30 text-gray-300">
                            
                            <tr class="hover:bg-[#161930]/40 transition duration-150">
                                <td class="py-3.5 font-mono font-bold text-gray-400">#DEP-83921</td>
                                <td class="py-3.5 font-bold text-white">إيداع رصيد (شحن محفظة)</td>
                                <td class="py-3.5 text-gray-500 font-mono">2026-05-22 09:12</td>
                                <td class="py-3.5 font-mono font-bold text-cyan-400 text-left">+$2,000.00</td>
                                <td class="py-3.5 text-center">
                                    <span class="bg-cyan-500/10 text-cyan-400 px-2.5 py-1 rounded-lg border border-cyan-500/10 text-[10px] font-bold">ناجح</span>
                                </td>
                            </tr>

                            <tr class="hover:bg-[#161930]/40 transition duration-150">
                                <td class="py-3.5 font-mono font-bold text-gray-400">#SAL-48201</td>
                                <td class="py-3.5 font-bold text-white">صرف الراتب الشهري الثابت</td>
                                <td class="py-3.5 text-gray-500 font-mono">2026-05-15 00:00</td>
                                <td class="py-3.5 font-mono font-bold text-amber-400 text-left">+$500.00</td>
                                <td class="py-3.5 text-center">
                                    <span class="bg-amber-500/10 text-amber-400 px-2.5 py-1 rounded-lg border border-amber-500/10 text-[10px] font-bold">تم الإيداع</span>
                                </td>
                            </tr>

                            <tr class="hover:bg-[#161930]/40 transition duration-150">
                                <td class="py-3.5 font-mono font-bold text-gray-400">#REF-29103</td>
                                <td class="py-3.5 font-bold text-white">عمولة إحالة مباشرة (أحمد علي)</td>
                                <td class="py-3.5 text-gray-500 font-mono">2026-05-12 14:22</td>
                                <td class="py-3.5 font-mono font-bold text-emerald-400 text-left">+$150.00</td>
                                <td class="py-3.5 text-center">
                                    <span class="bg-emerald-500/10 text-emerald-400 px-2.5 py-1 rounded-lg border border-emerald-500/10 text-[10px] font-bold">مكتملة</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-6 bg-[#111322]/60 backdrop-blur-md border border-gray-850 rounded-2xl flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="border-b border-gray-850/60 pb-4">
                        <h2 class="text-sm font-bold text-white">رابط الإحالة الخاص بك</h2>
                        <p class="text-[11px] text-gray-500 mt-0.5">شارك الرابط لبناء فريقك والحصول على عمولات فورية ورواتب مستمرة.</p>
                    </div>

                    <div x-data="{ copied: false, refLink: 'https://neoninvest.com/register?ref=faresnasser' }" class="space-y-2">
                        <div class="relative flex items-center">
                            <input type="text" x-model="refLink" readonly 
                                   class="w-full bg-[#161930]/60 border border-gray-800 rounded-xl pl-12 pr-4 py-3 text-xs font-mono text-gray-300 focus:outline-none" />
                            <button @click="navigator.clipboard.writeText(refLink); copied = true; setTimeout(() => copied = false, 2000)" 
                                    type="button"
                                    class="absolute left-2 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-black p-1.5 rounded-lg text-[10px] transition focus:outline-none">
                                <span x-show="!copied">نسخ</span>
                                <span x-show="copied" style="display: none;">تم!</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-3 bg-[#161930]/40 border border-gray-850 rounded-xl space-y-2">
                        <h4 class="text-[11px] font-bold text-white">مستويات عمولات الفريق:</h4>
                        <div class="flex justify-between text-[10px] text-gray-400">
                            <span>المستوى 1 (مباشر):</span>
                            <span class="text-emerald-400 font-bold font-mono">10%</span>
                        </div>
                        <div class="flex justify-between text-[10px] text-gray-400">
                            <span>المستوى 2:</span>
                            <span class="text-purple-400 font-bold font-mono">5%</span>
                        </div>
                        <div class="flex justify-between text-[10px] text-gray-400">
                            <span>المستوى 3:</span>
                            <span class="text-cyan-400 font-bold font-mono">2%</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-850/60 text-[10px] text-gray-500 text-center font-mono">
                    System Secured Matrix Network Verification
                </div>
            </div>

        </div>

    </div>
