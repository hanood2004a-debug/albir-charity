<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        $donations = Donation::with(['user', 'project'])->latest()->paginate(15);

        return view('admin.donations.index', compact('donations'));
    }
}
