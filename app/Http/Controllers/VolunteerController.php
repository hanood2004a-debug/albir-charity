<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use App\Models\VolunteerOpportunity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VolunteerController extends Controller
{
    public function index(Request $request): View
    {
        $opportunities = VolunteerOpportunity::where('status', 'open')
            ->withCount('applications')
            ->latest()
            ->get();

        // لو المستخدم مسجل دخول، نجيب قائمة الفرص يلي قدّم عليها مسبقاً (عشان نعطل زر "قدّم" عليها)
        $appliedOpportunityIds = [];
        if ($request->user()) {
            $appliedOpportunityIds = VolunteerApplication::where('user_id', $request->user()->id)
                ->pluck('opportunity_id')
                ->toArray();
        }

        return view('volunteer.index', compact('opportunities', 'appliedOpportunityIds'));
    }

    public function apply(Request $request, VolunteerOpportunity $opportunity): RedirectResponse
    {
        $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        $alreadyApplied = VolunteerApplication::where('user_id', $request->user()->id)
            ->where('opportunity_id', $opportunity->id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'أنت مقدّم على هذه الفرصة مسبقاً.');
        }

        VolunteerApplication::create([
            'user_id' => $request->user()->id,
            'opportunity_id' => $opportunity->id,
            'message' => $request->input('message'),
            'status' => 'pending',
        ]);

        return back()->with('success', 'تم إرسال طلبك بنجاح! رح نتواصل معك قريباً.');
    }
}
