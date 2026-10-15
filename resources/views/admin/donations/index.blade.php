@extends('layouts.admin')

@section('title', 'التبرعات')

@section('content')

    <h1 class="text-2xl font-extrabold mb-6">التبرعات</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-right">
            <thead class="bg-gray-50 text-gray-500 border-b">
                <tr>
                    <th class="py-3 px-4">المتبرع</th>
                    <th class="py-3 px-4">المشروع</th>
                    <th class="py-3 px-4">المبلغ</th>
                    <th class="py-3 px-4">بوابة الدفع</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4">التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr class="border-b last:border-0">
                        <td class="py-3 px-4 font-bold">{{ $donation->user->name ?? $donation->donor_name ?? 'زائر' }}</td>
                        <td class="py-3 px-4">{{ $donation->project->title_ar ?? 'صندوق عام' }}</td>
                        <td class="py-3 px-4">{{ number_format($donation->amount, 0) }} {{ $donation->currency }}</td>
                        <td class="py-3 px-4">{{ $donation->payment_gateway ?? '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($donation->status === 'completed') bg-emerald-100 text-emerald-700
                                @elseif($donation->status === 'failed') bg-red-100 text-red-700
                                @else bg-amber-100 text-amber-700
                                @endif">
                                {{ $donation->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $donation->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 px-4 text-center text-gray-500">ما في تبرعات مسجلة بعد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $donations->links() }}
    </div>

@endsection
