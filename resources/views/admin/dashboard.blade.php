@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')

    <h1 class="text-2xl font-extrabold mb-6">نظرة عامة</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-3xl font-extrabold text-emerald-700">{{ $stats['projects_count'] }}</div>
            <div class="text-gray-500 mt-1">إجمالي المشاريع ({{ $stats['active_projects_count'] }} نشط)</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-3xl font-extrabold text-emerald-700">{{ $stats['users_count'] }}</div>
            <div class="text-gray-500 mt-1">إجمالي المستخدمين</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-3xl font-extrabold text-emerald-700">{{ number_format($stats['donations_total'], 0) }} $</div>
            <div class="text-gray-500 mt-1">إجمالي التبرعات ({{ $stats['donations_count'] }} عملية)</div>
        </div>
    </div>

    @if($stats['pending_applications_count'] > 0)
        <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-lg p-4 mb-8">
            📋 عندك {{ $stats['pending_applications_count'] }} طلب تطوع بانتظار المراجعة —
            <a href="{{ route('admin.volunteers.index') }}" class="font-bold underline">اضغط هون للمراجعة</a>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-bold text-lg mb-4">آخر التبرعات</h2>

        @if($recentDonations->isEmpty())
            <p class="text-gray-500">ما في تبرعات مسجلة بعد.</p>
        @else
            <table class="w-full text-sm text-right">
                <thead class="text-gray-500 border-b">
                    <tr>
                        <th class="py-2">المتبرع</th>
                        <th class="py-2">المشروع</th>
                        <th class="py-2">المبلغ</th>
                        <th class="py-2">الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentDonations as $donation)
                        <tr class="border-b last:border-0">
                            <td class="py-2">{{ $donation->user->name ?? $donation->donor_name ?? 'زائر' }}</td>
                            <td class="py-2">{{ $donation->project->title_ar ?? 'صندوق عام' }}</td>
                            <td class="py-2">{{ number_format($donation->amount, 0) }} {{ $donation->currency }}</td>
                            <td class="py-2">{{ $donation->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
