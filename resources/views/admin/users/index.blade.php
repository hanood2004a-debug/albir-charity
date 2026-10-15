@extends('layouts.admin')

@section('title', 'المستخدمون')

@section('content')

    <h1 class="text-2xl font-extrabold mb-6">المستخدمون</h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-right">
            <thead class="bg-gray-50 text-gray-500 border-b">
                <tr>
                    <th class="py-3 px-4">الاسم</th>
                    <th class="py-3 px-4">البريد الإلكتروني</th>
                    <th class="py-3 px-4">الهاتف</th>
                    <th class="py-3 px-4">نوع الحساب</th>
                    <th class="py-3 px-4">تاريخ التسجيل</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b last:border-0">
                        <td class="py-3 px-4 font-bold">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->phone ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $user->role->name_ar ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 px-4 text-center text-gray-500">ما في مستخدمين مسجلين.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

@endsection
