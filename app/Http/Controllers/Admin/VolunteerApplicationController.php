<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VolunteerApplicationController extends Controller
{
    public function index(): View
    {
        $applications = VolunteerApplication::with(['user', 'opportunity'])->latest()->paginate(15);

        return view('admin.volunteers.index', compact('applications'));
    }

    public function update(Request $request, VolunteerApplication $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application->update($validated);

        return redirect()->route('admin.volunteers.index')->with('success', 'تم تحديث حالة الطلب.');
    }
}
