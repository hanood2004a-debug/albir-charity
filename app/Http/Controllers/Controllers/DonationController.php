<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DonationController extends Controller
{
    // عرض فورم التبرع (لمشروع محدد أو للصندوق العام)
    public function create(Request $request): View
    {
        $project = null;

        if ($request->filled('project')) {
            $project = Project::findOrFail($request->input('project'));
        }

        return view('donations.create', compact('project'));
    }

    // معالجة الفورم وإنشاء عملية دفع عبر Lahza
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        // ننشئ سجل التبرع بحالة "pending" الأول، قبل ما نحول المستخدم لصفحة الدفع
        $donation = Donation::create([
            'user_id' => $request->user()?->id,
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'project_id' => $validated['project_id'] ?? null,
            'amount' => $validated['amount'],
            'currency' => 'ILS',
            'payment_gateway' => 'lahza',
            'status' => 'pending',
        ]);

        // Lahza بتاخد المبلغ بأصغر وحدة عملة (أغورة للشيكل)، يعني بنضرب *100
        $amountInAgora = (int) round($validated['amount'] * 100);

        $response = Http::withToken(config('services.lahza.secret'))
            ->post('https://api.lahza.io/transaction/initialize', [
                'email' => $validated['donor_email'],
                'amount' => $amountInAgora,
                'currency' => 'ILS',
                'reference' => 'donation_' . $donation->id . '_' . uniqid(),
                'callback_url' => route('donations.success', ['donation' => $donation->id]),
            ]);

        if (! $response->successful() || ! $response->json('status')) {
            Log::error('Lahza initialize failed', ['response' => $response->body()]);

            $donation->update(['status' => 'failed']);

            return back()->withErrors(['amount' => 'حصل خطأ أثناء إنشاء عملية الدفع، حاول مرة أخرى.']);
        }

        $data = $response->json('data');

        $donation->update(['transaction_id' => $data['reference']]);

        return redirect($data['authorization_url']);
    }

    // صفحة الرجوع بعد الدفع (سواء نجح أو لأ) - Lahza بترجع المستخدم لهون
    public function success(Request $request, Donation $donation): View
    {
        if ($donation->transaction_id && $donation->status === 'pending') {
            $response = Http::withToken(config('services.lahza.secret'))
                ->get('https://api.lahza.io/transaction/verify/' . $donation->transaction_id);

            if ($response->successful() && $response->json('status')) {
                $data = $response->json('data');

                if (($data['status'] ?? null) === 'success') {
                    $donation->update(['status' => 'completed']);

                    if ($donation->project) {
                        $donation->project->increment('raised_amount', $donation->amount);
                    }
                } else {
                    $donation->update(['status' => 'failed']);
                }
            }
        }

        return view('donations.success', compact('donation'));
    }

    // صفحة لما المستخدم يلغي عملية الدفع من صفحة Lahza نفسها
    public function cancel(Donation $donation): View
    {
        $donation->update(['status' => 'failed']);

        return view('donations.cancel', compact('donation'));
    }
}
