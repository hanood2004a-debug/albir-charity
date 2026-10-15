<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Donation;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $projectsCount = Project::where('status', 'active')->count();
        $totalRaised = Donation::where('status', 'completed')->sum('amount');
        $volunteersCount = User::whereHas('role', fn ($q) => $q->where('name', 'volunteer'))->count();

        $latestProjects = Project::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'projectsCount',
            'totalRaised',
            'volunteersCount',
            'latestProjects'
        ));
    }
}
