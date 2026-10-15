@extends('layouts.admin')

@section('title', 'إضافة مشروع')

@section('content')

    <h1 class="text-2xl font-extrabold mb-6">إضافة مشروع جديد</h1>

    <div class="bg-white rounded-xl shadow p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.projects.store') }}">
            @include('admin.projects._form')
        </form>
    </div>

@endsection
