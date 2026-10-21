@extends('layouts.app')

@section('title', 'AI Career Coach — Cố vấn Nghề nghiệp AI Nguồn mở')

@section('content')
<div class="relative overflow-hidden">
    <!-- Phần Hero chính với nút "Bắt đầu" và "Dùng CV mẫu" theo mục 4.7 PLAN.md -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16 lg:pt-20 lg:pb-24">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-tight">
                {{ __('Cố vấn Nghề nghiệp AI Nguồn mở cho Sinh viên') }}
            </h1>

            <p class="mt-5 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                {{ __('Phân tích khoảng cách kỹ năng từ CV & JD với trích dẫn nguyên văn, gợi ý lộ trình học tập RAG chuẩn xác và luyện phỏng vấn thích ứng — hoàn toàn chạy local với Ollama.') }}
            </p>

            <!-- 2 nút hành động chính trên Landing theo mục 4.7 PLAN.md -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('onboarding') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-500/25 transition">
                    <span>{{ __('Bắt đầu phân tích') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>

                <a href="{{ route('onboarding', ['sample' => 'fresher-php']) }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-900 dark:text-slate-100 font-semibold border border-slate-300 dark:border-slate-700 transition">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ __('Dùng CV mẫu') }} (1-Click Demo)</span>
                </a>
            </div>
        </div>

        <!-- 4 Tính năng cốt lõi của hệ thống -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold mb-4">01</div>
                <h3 class="font-bold text-base mb-2">Trích dẫn Bằng chứng Thật</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400">Mọi kỹ năng và khoảng cách (Gap) đều đi kèm đoạn trích nguyên văn (<code>evidence</code>) được máy chủ đối chiếu trực tiếp với văn bản CV & JD gốc.</p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold mb-4">02</div>
                <h3 class="font-bold text-base mb-2">Chuẩn hoá Kỹ năng 3 Tầng</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400">Kết hợp khớp Alias chính xác, tìm kiếm láng giềng Vector (<code>bge-m3</code> Cosine ≥ 0.82) và LLM phân giải ngữ nghĩa về Taxonomy chuẩn.</p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold mb-4">03</div>
                <h3 class="font-bold text-base mb-2">Lộ trình Học Hybrid RAG</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400">Truy xuất tài liệu mở bằng Vector + Full-Text kết hợp Reciprocal Rank Fusion (RRF k=60) và tự động cân bằng số giờ học mỗi tuần.</p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center font-bold mb-4">04</div>
                <h3 class="font-bold text-base mb-2">Phỏng vấn Thử Thích ứng</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400">Tự động tăng/giảm độ khó theo điểm câu trước và chấm điểm khách quan dựa trên đáp án tham chiếu theo 3 tiêu chí Rubric.</p>
            </div>
        </div>

        @if ($recentReports->isNotEmpty())
            <div class="mt-14">
                <h2 class="text-lg font-bold mb-4">Báo cáo Phân tích Gần đây</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($recentReports as $rep)
                        <a href="{{ route('reports.show', $rep->id) }}"
                           class="block p-5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-indigo-500 transition">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-slate-500">{{ $rep->created_at?->diffForHumans() }}</span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-600 dark:text-indigo-400">
                                    {{ round($rep->match_score * 100) }}% Match
                                </span>
                            </div>
                            <div class="font-semibold text-sm truncate">{{ $rep->profile?->title ?? 'Hồ sơ CV' }}</div>
                            <div class="text-xs text-slate-500 truncate mt-1">Mục tiêu: {{ $rep->jobTarget?->title ?? 'Vị trí tuyển dụng' }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</div>
@endsection
