<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Check if current user can manage users (create/edit/delete)
     */
    private function canManageUsers()
    {
        return Auth::user()->canManageUsers();
    }

    /**
     * Check if current user can edit specific user
     */
    private function canEditUser(User $user)
    {
        // Admin can edit anyone, Kepala Sekolah can only edit Staff TU
        if (Auth::user()->role === 'admin') {
            return true;
        }
        if (Auth::user()->role === 'kepala_sekolah' && $user->role === 'staff_tu') {
            return true;
        }
        return false;
    }

    //index
    public function index()
    {
        // Check permission
        if (!$this->canManageUsers()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Search only staff TU accounts, pagination 10
        $users = User::where('role', User::ROLE_STAFF_TU)
            ->where('name', 'like', '%' . request('name') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    //create
    public function create()
    {
        // Check permission
        if (!$this->canManageUsers()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return view('pages.users.create');
    }

    //store
    public function store(Request $request)
    {
        // Check permission
        if (!$this->canManageUsers()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => User::ROLE_STAFF_TU,
            'password' => Hash::make($request->password),
            'position' => $request->position ?? 'Staff TU',
            'department' => $request->department ?? 'Tata Usaha',
        ]);

        return redirect()->route('users.index')->with('success', 'Akun Staff TU berhasil dibuat');
    }

    //edit
    public function edit(User $user)
    {
        // Check permission
        if (!$this->canEditUser($user)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return view('pages.users.edit', compact('user'));
    }

    //update
    public function update(Request $request, User $user)
    {
        // Check permission
        if (!$this->canEditUser($user)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => User::ROLE_STAFF_TU,
            'position' => $request->position ?? $user->position,
            'department' => $request->department ?? $user->department,
        ]);

        //if password filled
        if ($request->password) {
            $request->validate(['password' => 'required|min:8']);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Data Staff TU berhasil diperbarui');
    }

    /**
     * Reset staff TU password
     */
    public function resetPassword(User $user)
    {
        // Check permission - only staff_tu role can be reset
        if (!$this->canManageUsers() || $user->role !== 'staff_tu') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return view('pages.users.reset-password', compact('user'));
    }

    /**
     * Store reset password
     */
    public function storeResetPassword(Request $request, User $user)
    {
        // Check permission
        if (!$this->canManageUsers() || $user->role !== 'staff_tu') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Password Staff TU berhasil direset');
    }

    //destroy
    public function destroy(User $user)
    {
        // Check permission
        if (!$this->canEditUser($user)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun Staff TU berhasil dihapus');
    }
}
