<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        // Hanya admin dan kepala sekolah yang bisa membuat akun
        if (!Auth::check() || !Auth::user()->canManageUsers()) {
            return redirect('/login')->with('error', 'Hanya Kepala Sekolah yang bisa membuat akun baru.');
        }

        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_STAFF_TU, // Default role untuk user baru adalah staff_tu
        ]);

        return redirect('/dashboard')->with('success', 'Akun berhasil dibuat! User dapat login dengan email dan password yang sudah diberikan.');
    }
}
