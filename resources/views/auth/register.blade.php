@extends('layouts.app')

@section('title', 'إنشاء حساب - جمعية الخير')

@section('content')

    <section class="max-w-md mx-auto px-4 py-16">
        <div class="bg-white rounded-xl shadow p-8">
            <h1 class="text-2xl font-extrabold mb-6 text-center">إنشاء حساب جديد</h1>

            @if($errors->any())
                <div class="bg-red-50 text-red-700 rounded-lg p-4 mb-4 text-sm">
                    <ul class="list-disc pr-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-bold mb-1">الاسم الكامل</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">رقم الهاتف (اختياري)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">نوع الحساب</label>
                    <select name="role" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                        <option value="donor" {{ old('role') === 'donor' ? 'selected' : '' }}>متبرع</option>
                        <option value="volunteer" {{ old('role') === 'volunteer' ? 'selected' : '' }}>متطوع</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">كلمة المرور</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <button type="submit"
                    class="w-full bg-emerald-700 text-white py-3 rounded-lg font-bold hover:bg-emerald-800">
                    إنشاء الحساب
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                عندك حساب مسبقاً؟
                <a href="{{ route('login') }}" class="text-emerald-700 font-bold hover:underline">سجل دخولك</a>
            </p>
        </div>
    </section>

@endsection
