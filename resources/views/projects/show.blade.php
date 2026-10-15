@extends('layouts.app')

@section('title', $project->title_ar . ' - جمعية الخير')

@section('content')

    <section class="max-w-4xl mx-auto px-4 py-12">
        <a href="{{ route('projects.index') }}" class="text-emerald-700 hover:underline mb-6 inline-block">→ رجوع لكل المشاريع</a>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="h-56 bg-emerald-100 flex items-center justify-center text-emerald-700 text-6xl">
                🌱
            </div>
            <div class="p-6">
                <h1 class="text-2xl font-extrabold mb-4">{{ $project->title_ar }}</h1>
                <p class="text-gray-600 mb-6">{{ $project->description_ar }}</p>

                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="bg-emerald-600 h-3 rounded-full" style="width: {{ $project->progress_percent }}%"></div>
                </div>
                <p class="text-sm text-gray-500 mb-6">
                    تم جمع {{ number_format($project->raised_amount, 0) }} $ من أصل {{ number_format($project->goal_amount, 0) }} $
                    ({{ $project->progress_percent }}%)
                </p>

                <a href="#" class="bg-emerald-700 text-white px-6 py-3 rounded-lg font-bold hover:bg-emerald-800 inline-block">
                    ساهم بهذا المشروع
                </a>
            </div>
        </div>
    </section>

@endsection
