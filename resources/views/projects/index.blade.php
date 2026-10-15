@extends('layouts.app')

@section('title', 'مشاريعنا - جمعية الخير')

@section('content')

    <section class="max-w-6xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-extrabold mb-8">مشاريعنا</h1>

        @if($projects->isEmpty())
            <p class="text-gray-500">لا توجد مشاريع متاحة حالياً. تابعونا قريباً!</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="bg-white rounded-xl shadow overflow-hidden flex flex-col">
                        <div class="h-40 bg-emerald-100 flex items-center justify-center text-emerald-700 text-4xl">
                            🌱
                        </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="font-bold text-lg mb-2">{{ $project->title_ar }}</h3>
                            <p class="text-sm text-gray-500 mb-4 flex-1">{{ Str::limit($project->description_ar, 80) }}</p>

                            <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                                <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $project->progress_percent }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mb-4">
                                {{ number_format($project->raised_amount, 0) }} $ من أصل {{ number_format($project->goal_amount, 0) }} $
                            </p>

                            <a href="#" class="bg-emerald-700 text-white text-center py-2 rounded-lg font-bold hover:bg-emerald-800">
                                ساهم بهذا المشروع
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @endif
    </section>

@endsection
