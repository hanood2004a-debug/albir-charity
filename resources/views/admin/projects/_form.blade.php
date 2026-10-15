@csrf

@if($errors->any())
    <div class="bg-red-50 text-red-700 rounded-lg p-4 mb-4 text-sm">
        <ul class="list-disc pr-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-bold mb-1">العنوان (عربي)</label>
        <input type="text" name="title_ar" value="{{ old('title_ar', $project->title_ar ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm font-bold mb-1">العنوان (إنجليزي)</label>
        <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>
</div>

<div class="mt-4">
    <label class="block text-sm font-bold mb-1">الوصف (عربي)</label>
    <textarea name="description_ar" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('description_ar', $project->description_ar ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label class="block text-sm font-bold mb-1">الوصف (إنجليزي)</label>
    <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('description', $project->description ?? '') }}</textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
    <div>
        <label class="block text-sm font-bold mb-1">المبلغ المستهدف ($)</label>
        <input type="number" step="0.01" name="goal_amount" value="{{ old('goal_amount', $project->goal_amount ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm font-bold mb-1">المبلغ المجموع حالياً ($)</label>
        <input type="number" step="0.01" name="raised_amount" value="{{ old('raised_amount', $project->raised_amount ?? 0) }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm font-bold mb-1">الحالة</label>
        <select name="status" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
            @foreach(['draft' => 'مسودة', 'active' => 'نشط', 'completed' => 'مكتمل', 'cancelled' => 'ملغي'] as $value => $label)
                <option value="{{ $value }}" {{ old('status', $project->status ?? '') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
    <div>
        <label class="block text-sm font-bold mb-1">تاريخ البداية</label>
        <input type="date" name="start_date" value="{{ old('start_date', optional($project->start_date ?? null)->format('Y-m-d')) }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm font-bold mb-1">تاريخ النهاية</label>
        <input type="date" name="end_date" value="{{ old('end_date', optional($project->end_date ?? null)->format('Y-m-d')) }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2">
    </div>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="bg-emerald-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-emerald-800">
        حفظ
    </button>
    <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 rounded-lg font-bold text-gray-600 hover:bg-gray-100">
        إلغاء
    </a>
</div>
