@extends('layouts.app')

@section('title', 'تطوع معنا - جمعية الخير')

@section('content')

    <section class="max-w-6xl mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold mb-3">تطوع معنا</h1>
            <p class="text-gray-500">اختر فرصة تطوع تناسبك وكن جزءاً من التغيير الحقيقي.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-700 border border-red-200 rounded-lg p-4 mb-6 text-center">
                {{ session('error') }}
            </div>
        @endif

        @guest
            <div class="bg-amber-50 text-amber-800 border border-amber-200 rounded-lg p-4 mb-8 text-center">
                لازم <a href="{{ route('login') }}" class="font-bold underline">تسجل دخولك</a>
                أو <a href="{{ route('register') }}" class="font-bold underline">تعمل حساب</a> عشان تقدر تقدّم على فرص التطوع.
            </div>
        @endguest

        @if($opportunities->isEmpty())
            <p class="text-gray-500 text-center">ما في فرص تطوع متاحة حالياً. تابعونا قريباً!</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($opportunities as $opportunity)
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col">
                        <h3 class="font-bold text-lg mb-2">{{ $opportunity->title_ar }}</h3>
                        <p class="text-gray-500 text-sm mb-4 flex-1">{{ $opportunity->description_ar }}</p>

                        @if($opportunity->project)
                            <p class="text-xs text-emerald-700 mb-2">🔗 مرتبط بمشروع: {{ $opportunity->project->title_ar }}</p>
                        @endif

                        <p class="text-xs text-gray-400 mb-4">
                            {{ $opportunity->spots_available }} مقعد متاح · {{ $opportunity->applications_count }} متقدّم لحد الآن
                        </p>

                        @auth
                            @if(in_array($opportunity->id, $appliedOpportunityIds))
                                <button disabled class="bg-gray-200 text-gray-500 py-2 rounded-lg font-bold cursor-not-allowed">
                                    قدّمت مسبقاً ✓
                                </button>
                            @else
                                <form method="POST" action="{{ route('volunteer.apply', $opportunity) }}" class="space-y-2">
                                    @csrf
                                    <textarea name="message" rows="2" placeholder="ليش بدك تتطوع بهاي الفرصة؟ (اختياري)"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"></textarea>
                                    <button type="submit" class="w-full bg-emerald-700 text-white py-2 rounded-lg font-bold hover:bg-emerald-800">
                                        قدّم الآن
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-center bg-gray-100 text-gray-600 py-2 rounded-lg font-bold hover:bg-gray-200">
                                سجل دخولك للتقديم
                            </a>
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection
