<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    // عرض فورم تسجيل الدخول
    public function create(): View
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'أهلاً بعودتك!');
        }

        return back()
            ->withErrors(['email' => 'بيانات الدخول غير صحيحة، حاول مرة أخرى.'])
            ->onlyInput('email');
    }

    // تسجيل الخروج
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'تم تسجيل خروجك بنجاح.');
    }
}
