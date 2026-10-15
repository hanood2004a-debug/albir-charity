<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Project;
use App\Models\User;
use App\Models\VolunteerApplication;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects_count' => Project::count(),
            'active_projects_count' => Project::where('status', 'active')->count(),
            'users_count' => User::count(),
            'donations_total' => Donation::where('status', 'completed')->sum('amount'),
            'donations_count' => Donation::count(),
            'pending_applications_count' => VolunteerApplication::where('status', 'pending')->count(),
        ];

        $recentDonations = Donation::with(['user', 'project'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentDonations'));
    }
}
