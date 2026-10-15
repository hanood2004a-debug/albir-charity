@extends('layouts.admin')

@section('title', 'تعديل مشروع')

@section('content')

    <h1 class="text-2xl font-extrabold mb-6">تعديل: {{ $project->title_ar }}</h1>

    <div class="bg-white rounded-xl shadow p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}">
            @method('PUT')
            @include('admin.projects._form')
        </form>
    </div>

@endsection
