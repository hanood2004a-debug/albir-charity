<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم - جمعية الخير')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        <!-- القائمة الجانبية -->
        <aside class="w-64 bg-gray-900 text-gray-200 flex-shrink-0">
            <div class="p-6 text-xl font-bold text-white border-b border-gray-700">
                🌿 لوحة التحكم
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-700 text-white' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('admin.projects.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.projects.*') ? 'bg-emerald-700 text-white' : '' }}">
                    المشاريع
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-emerald-700 text-white' : '' }}">
                    المستخدمون
                </a>
                <a href="{{ route('admin.donations.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.donations.*') ? 'bg-emerald-700 text-white' : '' }}">
                    التبرعات
                </a>
                <a href="{{ route('admin.volunteers.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-800 {{ request()->routeIs('admin.volunteers.*') ? 'bg-emerald-700 text-white' : '' }}">
                    طلبات التطوع
                </a>
                <div class="border-t border-gray-700 my-3"></div>
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-800 text-gray-400">
                    ← رجوع للموقع
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-right px-4 py-2 rounded-lg hover:bg-gray-800 text-gray-400">
                        تسجيل خروج
                    </button>
                </form>
            </nav>
        </aside>

        <!-- المحتوى -->
        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>

</body>
</html>
