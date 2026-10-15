<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'جمعية الخير')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- شريط التنقل -->
    <nav class="bg-emerald-700 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold">🌿 جمعية الخير</a>
            <div class="flex gap-6 text-sm md:text-base items-center">
                <a href="{{ route('home') }}" class="hover:text-emerald-200">الرئيسية</a>
                <a href="{{ route('projects.index') }}" class="hover:text-emerald-200">مشاريعنا</a>
                <a href="{{ route('volunteer.index') }}" class="hover:text-emerald-200">تطوع معنا</a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-200">لوحة التحكم</a>
                    @endif
                    <span class="text-emerald-100 text-sm">أهلاً، {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-emerald-700 px-4 py-1.5 rounded-full font-bold hover:bg-emerald-100">
                            تسجيل خروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-emerald-200">تسجيل دخول</a>
                    <a href="{{ route('register') }}" class="bg-white text-emerald-700 px-4 py-1.5 rounded-full font-bold hover:bg-emerald-100">
                        تبرّع الآن
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- رسائل النجاح -->
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg p-4 text-center">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- الفوتر -->
    <footer class="bg-gray-900 text-gray-300 mt-16 py-8">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm">
            <p>© {{ date('Y') }} جمعية الخير. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

</body>
</html>
