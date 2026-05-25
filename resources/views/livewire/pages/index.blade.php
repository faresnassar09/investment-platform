
<?php
use Livewire\Component;

new class extends Component
{
};
?>

<div class="antialiased min-h-screen text-gray-200 overflow-x-hidden relative" dir="rtl" 
     style="font-family: 'Cairo', sans-serif; background-color: #0b0c16;">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0" style="background: radial-gradient(circle at 20% 30%, #1a103c 0%, #0b0c16 60%);"></div>
        <div class="absolute inset-0 opacity-25" style="background-image: radial-gradient(#22d3ee 0.5px, transparent 0.5px); background-size: 30px 30px;"></div>
        <div class="absolute top-1/2 right-10 w-[600px] h-[600px] bg-cyan-950/20 rounded-full blur-[140px]"></div>
        <div class="absolute bottom-10 left-10 w-[400px] h-[400px] bg-purple-950/20 rounded-full blur-[120px]"></div>
    </div>

    <style>
        .neon-text-glow { text-shadow: 0 0 10px rgba(34, 211, 238, 0.6); }
        .neon-btn-glow { box-shadow: 0 0 20px rgba(34, 211, 238, 0.4); }
        .neon-card { box-shadow: 0 0 15px rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.15); }
        html { scroll-behavior: smooth; }
    </style>

    <header class="w-full fixed top-0 z-50 bg-[#0b0c16]/70 backdrop-blur-md border-b border-gray-800/40 px-6 md:px-12 h-20 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-gradient-to-tr from-emerald-500 to-cyan-500 p-2 rounded-xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div>
                <h1 class="text-white font-black text-xl tracking-tight">Investment <span class="text-cyan-400">Hub</span></h1>
                <span class="text-[10px] text-gray-500 block -mt-1">Affiliates Platform</span>
            </div>
        </div>

        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
            <a href="#" class="text-cyan-400 font-bold transition">الصفحة الرئيسية</a>
            <a href="#features" class="text-gray-400 hover:text-white transition">المميزات</a>
            <a href="#stats" class="text-gray-400 hover:text-white transition">الأرقام</a>
            <a href="#testimonials" class="text-gray-400 hover:text-white transition">التوصيات</a>
        </nav>

        <div>
            <a href="#" class="bg-cyan-400 text-slate-950 font-extrabold px-6 py-2.5 rounded-xl text-sm transition transform hover:scale-105 neon-btn-glow">ابدأ الآن</a>
        </div>
    </header>

    <section class="relative z-10 min-h-screen pt-32 flex items-center px-6 md:px-12 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full">
            <div class="space-y-6 text-center lg:text-right" 
                 x-data="{ open: false }" x-init="setTimeout(() => open = true, 100)"
                 x-show="open" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8">
                <h2 class="text-4xl md:text-6xl font-black text-white leading-tight">
                    استثمر بذكاء. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-l from-cyan-400 to-purple-500">نمّي شبكتك.</span> <br>
                    حقق النجاح.
                </h2>
                <p class="text-gray-400 text-base md:text-lg max-w-xl leading-relaxed">
                    منصة <span class="text-white font-bold">Investment Hub</span> هي بوابتك الحصرية لبناء مجتمع استثماري مزدهر، تتبع الأداء بدقة متناهية، وتحقيق أرباح استثنائية من خلال قوة الـ Affiliates.
                </p>
                <div class="pt-4">
                    <button class="border-2 border-cyan-400 bg-cyan-950/30 text-cyan-400 text-lg md:text-xl font-black px-8 py-4 rounded-2xl transition duration-300 transform hover:scale-105 hover:bg-cyan-400 hover:text-slate-950 shadow-lg shadow-cyan-950/50">
                        ابدأ رحلتك الاستثمارية اليوم
                    </button>
                </div>
            </div>

            <div class="relative flex justify-center items-center"
                 x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
                 x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95">
                <div class="w-full max-w-md bg-[#111322]/80 backdrop-blur-md p-6 rounded-3xl border border-purple-500/20 shadow-2xl relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-xs font-bold text-purple-400 tracking-wider uppercase">Live Market Overview</span>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-[#161930]/60 p-4 rounded-2xl border border-gray-800">
                            <p class="text-xs text-gray-500">إجمالي الأرباح</p>
                            <p class="text-xl font-black text-cyan-400 mt-1 font-mono">+$2,136,330</p>
                        </div>
                        <div class="bg-[#161930]/60 p-4 rounded-2xl border border-gray-800">
                            <p class="text-xs text-gray-500">أعضاء الشبكة الجدد</p>
                            <p class="text-xl font-black text-purple-400 mt-1 font-mono">41+</p>
                        </div>
                    </div>

                    <div class="h-48 w-full">
                        <canvas id="heroChart"></canvas>
                    </div>
                </div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-tr from-cyan-500 to-purple-500 rounded-full blur-[80px] opacity-20"></div>
            </div>
        </div>
    </section>

    <section id="stats" class="relative z-10 py-20 bg-[#0e1020]/40 backdrop-blur-sm border-y border-gray-800/50">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-3xl md:text-5xl font-black text-white font-mono neon-text-glow">$150M+</p>
                <p class="text-xs md:text-sm text-gray-400 mt-2">إجمالي الاستثمارات المدارة</p>
            </div>
            <div>
                <p class="text-3xl md:text-5xl font-black text-cyan-400 font-mono">45K+</p>
                <p class="text-xs md:text-sm text-gray-400 mt-2">مستثمر نشط حول العالم</p>
            </div>
            <div>
                <p class="text-3xl md:text-5xl font-black text-purple-400 font-mono">$12M+</p>
                <p class="text-xs md:text-sm text-gray-400 mt-2">الأرباح الموزعة للمسوقين</p>
            </div>
            <div>
                <p class="text-3xl md:text-5xl font-black text-emerald-400 font-mono">99.9%</p>
                <p class="text-xs md:text-sm text-gray-400 mt-2">وقت تشغيل النظام والاستقرار</p>
            </div>
        </div>
    </section>

    <section id="features" class="relative z-10 py-32 px-6 max-w-7xl mx-auto" x-data="{ scrolled: false }" @scroll.window.passive="scrolled = (window.scrollY > 400)">
        <div class="text-center max-w-2xl mx-auto mb-20 transition duration-1000 transform" :class="scrolled ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
            <h3 class="text-xs font-bold text-cyan-400 tracking-widest uppercase mb-3">لماذا تختار منصتنا؟</h3>
            <h2 class="text-3xl md:text-5xl font-black text-white">أدوات متطورة لإدارة استثماراتك</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#111322]/40 backdrop-blur-sm p-8 rounded-3xl border border-gray-800 hover:border-cyan-500/40 transition-all duration-300 group transform hover:-translate-y-2 neon-card">
                <div class="bg-cyan-950/50 w-12 h-12 rounded-2xl flex items-center justify-center text-cyan-400 mb-6 group-hover:bg-cyan-400 group-hover:text-slate-950 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-white mb-3">حماية وأمان مطلق</h4>
                <p class="text-gray-400 text-sm leading-relaxed">تشفير كامل لكافة المعاملات المالية والبيانات الشخصية لشبكتك الاستثمارية بأعلى معايير الأمن السيبراني العالمي.</p>
            </div>

            <div class="bg-[#111322]/40 backdrop-blur-sm p-8 rounded-3xl border border-gray-800 hover:border-purple-500/40 transition-all duration-300 group transform hover:-translate-y-2 neon-card">
                <div class="bg-purple-950/50 w-12 h-12 rounded-2xl flex items-center justify-center text-purple-400 mb-6 group-hover:bg-purple-500 group-hover:text-slate-950 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-white mb-3">شجرة نظام تسويقي ذكي</h4>
                <p class="text-gray-400 text-sm leading-relaxed">نظام شجرة متطور وتفاعلي ثلاثي الأبعاد يتيح لك مراقبة مستويات الإحالة والأعضاء النشطين وعمولاتك بدقة فورية حية.</p>
            </div>

            <div class="bg-[#111322]/40 backdrop-blur-sm p-8 rounded-3xl border border-gray-800 hover:border-emerald-500/40 transition-all duration-300 group transform hover:-translate-y-2 neon-card">
                <div class="bg-emerald-950/50 w-12 h-12 rounded-2xl flex items-center justify-center text-emerald-400 mb-6 group-hover:bg-emerald-400 group-hover:text-slate-950 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-white mb-3">تقارير وإحصائيات متقدمة</h4>
                <p class="text-gray-400 text-sm leading-relaxed">رسوم بيانية تفاعلية متطورة تعكس بدقة متناهية نمو رأس مالك وأرباح شبكتك التسويقية يومًا بيوم وبشكل رسومي رائع.</p>
            </div>
        </div>
    </section>

    <section id="testimonials" class="relative z-10 py-24 bg-[#0a0b14]/60" x-data="{ activeTab: 1 }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h3 class="text-xs font-bold text-purple-400 tracking-widest uppercase mb-3">شركاء النجاح</h3>
                <h2 class="text-3xl md:text-4xl font-black text-white">ماذا يقول مستثمرو رتبة VIP عن تجربتهم؟</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-[#121426] p-8 rounded-3xl border border-gray-800 relative">
                    <span class="text-6xl text-cyan-500/10 absolute top-4 right-6 font-serif">“</span>
                    <div class="flex items-center gap-4 mb-6 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-cyan-900/40 border border-cyan-400 flex items-center justify-center font-bold text-white">ع</div>
                        <div>
                            <h4 class="font-bold text-white">عبد الرحمن خالد</h4>
                            <p class="text-xs text-gray-500">مستثمر رتبة VIP Diamond</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed relative z-10">
                        "تجربتي مع Investment Hub غيرت مفهومي عن الاستثمار تماماً. نظام تتبع أرباح شجرة الأفلييت دقيق وسريع وسحب الأرباح فوري بدون تعقيدات."
                    </p>
                </div>

                <div class="bg-[#121426] p-8 rounded-3xl border border-gray-800 relative">
                    <span class="text-6xl text-purple-500/10 absolute top-4 right-6 font-serif">“</span>
                    <div class="flex items-center gap-4 mb-6 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-purple-900/40 border border-purple-400 flex items-center justify-center font-bold text-white">م</div>
                        <div>
                            <h4 class="font-bold text-white">مريم الدوسري</h4>
                            <p class="text-xs text-gray-500">قائدة فريق تسويقي</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed relative z-10">
                        "بناء شبكة من 3 مستويات وتحتها فروع كان تحدياً في المنصات الأخرى، هنا الواجهة الشجرية تعطيني تحليلات فورية سهلت علي توجيه فريقي وضاعفت أرباحنا."
                    </p>
                </div>

                <div class="bg-[#121426] p-8 rounded-3xl border border-gray-800 relative">
                    <span class="text-6xl text-emerald-500/10 absolute top-4 right-6 font-serif">“</span>
                    <div class="flex items-center gap-4 mb-6 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-emerald-900/40 border border-emerald-400 flex items-center justify-center font-bold text-white">س</div>
                        <div>
                            <h4 class="font-bold text-white">سامح الغامدي</h4>
                            <p class="text-xs text-gray-500">مستثمر مستقل</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed relative z-10">
                        "أهم ما يميز هذه المنصة هو الشفافية والأمان المطروح. الرسوم البيانية تعكس الأرقام الحقيقية للسوق والعمولات تضاف بدقة متناهية."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="relative z-10 bg-[#07080f] border-t border-gray-800/60 pt-16 pb-8 text-gray-400">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-tr from-emerald-500 to-cyan-500 p-2 rounded-xl">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h2 class="text-white font-black text-lg">Investment Hub</h2>
                </div>
                <p class="text-xs leading-relaxed text-gray-500">
                    المنصة الرائدة تكنولوجياً لإدارة الاستثمارات الرقمية الفردية وبناء وإدارة شبكات التسويق بالعمولة بنظام حوكمة ذكي وموثوق.
                </p>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">روابط سريعة</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="#" class="hover:text-cyan-400 transition">تحليلات السوق الحية</a></li>
                    <li><a href="#features" class="hover:text-cyan-400 transition">خطط وعمولات الـ Affiliate</a></li>
                    <li><a href="#stats" class="hover:text-cyan-400 transition">لوحة إحصائيات المنصة</a></li>
                    <li><a href="#" class="hover:text-cyan-400 transition">مركز المساعدة والدعم</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">القوانين والخصوصية</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="#" class="hover:text-cyan-400 transition">شروط وأحكام الاستثمار</a></li>
                    <li><a href="#" class="hover:text-cyan-400 transition">سياسة حماية البيانات الشجرية</a></li>
                    <li><a href="#" class="hover:text-cyan-400 transition">إخلاء المسؤولية عن المخاطر</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <h4 class="text-white font-bold text-sm mb-4">اشترك في تحديثات السوق</h4>
                <div class="flex gap-2">
                    <input type="email" placeholder="بريدك الإلكتروني" class="bg-[#121426] border border-gray-800 rounded-xl px-3 py-2 text-xs w-full focus:outline-none focus:border-cyan-400 text-white">
                    <button class="bg-cyan-400 text-slate-950 font-bold px-4 py-2 rounded-xl text-xs hover:bg-cyan-300 transition">ارسال</button>
                </div>
                <p class="text-[10px] text-gray-600">لا نرسل رسائل مزعجة، يمكنك إلغاء الاشتراك في أي وقت.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-gray-900 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-600">
            <p class="text-center md:text-right max-w-xl leading-relaxed">
                تحذير من المخاطر: الاستثمار ينطوي على مخاطر تقلبات الأسواق. الأداء السابق لا يضمن النتائج المستقبلية. يرجى مراجعة القوانين بدقة.
            </p>
            <p class="font-medium font-mono text-[11px] shrink-0">
                Investment Hub Affiliates Platform © 2026
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('heroChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
                    datasets: [{
                        label: 'نمو العوائد الشجرية',
                        data: [14000, 21000, 18000, 31000, 27000, 42000],
                        borderColor: '#22d3ee',
                        borderWidth: 3,
                        pointBackgroundColor: '#8b5cf6',
                        pointRadius: 4,
                        tension: 0.4,
                        fill: true,
                        backgroundColor: function(context) {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                            gradient.addColorStop(0, 'rgba(34, 211, 238, 0.2)');
                            gradient.addColorStop(1, 'rgba(34, 211, 238, 0)');
                            return gradient;
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false }, ticks: { color: '#6b7280', font: { family: 'Cairo', size: 10 } } },
                        y: { grid: { color: 'rgba(255, 255, 255, 0.03)' }, ticks: { color: '#6b7280', font: { family: 'Cairo', size: 10 } } }
                    }
                }
            });
        });
    </script>
</div>

```