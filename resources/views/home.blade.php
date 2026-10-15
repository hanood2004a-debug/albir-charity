@extends('layouts.app')

@section('title', 'جمعية الخير - الرئيسية')

@section('content')

    <!-- Hero Section -->
    <section class="bg-emerald-700 text-white py-20 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">معاً نصنع فرقاً حقيقياً</h1>
            <p class="text-lg text-emerald-100 mb-8">
                جمعية خيرية تعمل على دعم المحتاجين عبر مشاريع تنموية وإنسانية مستدامة، بمساهمتكم وتطوعكم.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('projects.index') }}" class="bg-white text-emerald-700 font-bold px-6 py-3 rounded-full hover:bg-emerald-100">
                    شاهد مشاريعنا
                </a>
                <a href="#" class="border-2 border-white font-bold px-6 py-3 rounded-full hover:bg-white hover:text-emerald-700">
                    تبرّع الآن
                </a>
            </div>
        </div>
    </section>

    <!-- إحصائيات -->
    <section class="max-w-6xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-4xl font-extrabold text-emerald-700">{{ $projectsCount }}</div>
            <div class="text-gray-500 mt-2">مشروع نشط</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-4xl font-extrabold text-emerald-700">{{ number_format($totalRaised, 0) }} $</div>
            <div class="text-gray-500 mt-2">إجمالي التبرعات</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-4xl font-extrabold text-emerald-700">{{ $volunteersCount }}</div>
            <div class="text-gray-500 mt-2">متطوع مسجل</div>
        </div>
    </section>

    <!-- أحدث المشاريع -->
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">أحدث المشاريع</h2>

        @if($latestProjects->isEmpty())
            <p class="text-gray-500">لا توجد مشاريع مضافة بعد. أضف مشروعاً من لوحة التحكم ليظهر هنا.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestProjects as $project)
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="h-40 bg-emerald-100 flex items-center justify-center text-emerald-700 text-4xl">
                            🌱
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $project->title_ar }}</h3>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $project->progress_percent }}%"></div>
                            </div>
                            <p class="text-sm text-gray-500">{{ $project->progress_percent }}% من الهدف</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection
