<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    // عرض فورم التسجيل
    public function create(): View
    {
        return view('auth.register');
    }

    // معالجة إنشاء الحساب
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:donor,volunteer', // المستخدم بيختار نوع حسابه
        ]);

        $role = Role::where('name', $validated['role'])->first();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role_id' => $role?->id,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'مرحباً بك! تم إنشاء حسابك بنجاح.');
    }
}
