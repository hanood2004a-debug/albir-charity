@extends('layouts.admin')

@section('title', 'طلبات التطوع')

@section('content')

    <h1 class="text-2xl font-extrabold mb-6">طلبات التطوع</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-right">
            <thead class="bg-gray-50 text-gray-500 border-b">
                <tr>
                    <th class="py-3 px-4">المتطوع</th>
                    <th class="py-3 px-4">الفرصة</th>
                    <th class="py-3 px-4">الرسالة</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr class="border-b last:border-0">
                        <td class="py-3 px-4 font-bold">{{ $application->user->name }}</td>
                        <td class="py-3 px-4">{{ $application->opportunity->title_ar ?? '—' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ Str::limit($application->message, 40) }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($application->status === 'accepted') bg-emerald-100 text-emerald-700
                                @elseif($application->status === 'rejected') bg-red-100 text-red-700
                                @else bg-amber-100 text-amber-700
                                @endif">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 space-x-2 space-x-reverse">
                            @if($application->status !== 'accepted')
                                <form action="{{ route('admin.volunteers.update', $application) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="text-emerald-700 hover:underline">قبول</button>
                                </form>
                            @endif
                            @if($application->status !== 'rejected')
                                <form action="{{ route('admin.volunteers.update', $application) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="text-red-600 hover:underline">رفض</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-4 text-center text-gray-500">ما في طلبات تطوع بعد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $applications->links() }}
    </div>

@endsection
