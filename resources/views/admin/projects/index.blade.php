@extends('layouts.admin')

@section('title', 'إدارة المشاريع')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-extrabold">إدارة المشاريع</h1>
        <a href="{{ route('admin.projects.create') }}" class="bg-emerald-700 text-white px-5 py-2 rounded-lg font-bold hover:bg-emerald-800">
            + إضافة مشروع
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-right">
            <thead class="bg-gray-50 text-gray-500 border-b">
                <tr>
                    <th class="py-3 px-4">العنوان</th>
                    <th class="py-3 px-4">الهدف</th>
                    <th class="py-3 px-4">المجموع</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr class="border-b last:border-0">
                        <td class="py-3 px-4 font-bold">{{ $project->title_ar }}</td>
                        <td class="py-3 px-4">{{ number_format($project->goal_amount, 0) }} $</td>
                        <td class="py-3 px-4">{{ number_format($project->raised_amount, 0) }} $</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($project->status === 'active') bg-emerald-100 text-emerald-700
                                @elseif($project->status === 'completed') bg-blue-100 text-blue-700
                                @elseif($project->status === 'cancelled') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                {{ $project->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 space-x-2 space-x-reverse">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-emerald-700 hover:underline">تعديل</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline"
                                onsubmit="return confirm('متأكد بدك تحذف هذا المشروع؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-4 text-center text-gray-500">ما في مشاريع مضافة بعد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

@endsection
