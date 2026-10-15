@extends('layouts.app')

@section('title', 'تبرّع الآن - جمعية الخير')

@section('content')

    <section class="max-w-md mx-auto px-4 py-16">
        <div class="bg-white rounded-xl shadow p-8">
            <h1 class="text-2xl font-extrabold mb-2 text-center">تبرّع الآن</h1>
            <p class="text-gray-500 text-center mb-6">
                @if($project)
                    لمشروع: <span class="font-bold text-emerald-700">{{ $project->title_ar }}</span>
                @else
                    للصندوق العام للجمعية
                @endif
            </p>

            @if($errors->any())
                <div class="bg-red-50 text-red-700 rounded-lg p-4 mb-4 text-sm">
                    <ul class="list-disc pr-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('donations.store') }}" class="space-y-4">
                @csrf

                @if($project)
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                @endif

                <div>
                    <label class="block text-sm font-bold mb-1">الاسم الكامل</label>
                    <input type="text" name="donor_name" value="{{ old('donor_name', auth()->user()->name ?? '') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">البريد الإلكتروني</label>
                    <input type="email" name="donor_email" value="{{ old('donor_email', auth()->user()->email ?? '') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1">المبلغ (شيكل)</label>
                    <input type="number" name="amount" min="1" step="0.01" value="{{ old('amount', 50) }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">

                    <div class="flex gap-2 mt-2">
                        @foreach([25, 50, 100, 250] as $preset)
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = {{ $preset }}"
                                class="flex-1 border border-gray-300 rounded-lg py-1 text-sm hover:bg-gray-50">
                                {{ $preset }}₪
                            </button>
                        @endforeach
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-emerald-700 text-white py-3 rounded-lg font-bold hover:bg-emerald-800">
                    الانتقال للدفع 💳
                </button>

                <p class="text-xs text-gray-400 text-center">
                    الدفع آمن ومشفّر عبر بوابة "لحظة" الفلسطينية. هذا وضع تجريبي حالياً — لا يتم خصم أموال حقيقية.
                </p>
            </form>
        </div>
    </section>

@endsection
