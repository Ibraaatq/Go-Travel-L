<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Tampilkan daftar seluruh user di Admin Dashboard.
     * Route: GET /admin/users
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(User::latest()->get());
        }

        // Arahkan ke dashboard admin pada tab kelola pengguna
        return redirect()->route('admin', ['tab' => 'users']);
    }

    /**
     * Tambahkan akun Admin baru langsung dari dashboard.
     * Route: POST /admin/users
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,user',
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email ini sudah terdaftar oleh pengguna lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal harus 6 karakter.',
            'role.required'     => 'Role pengguna wajib dipilih.',
            'role.in'           => 'Role hanya boleh admin atau user.',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('admin', ['tab' => 'users'])
            ->with('success', "Akun {$user->name} dengan role {$user->role} berhasil ditambahkan!");
    }

    /**
     * Perbarui data pengguna (nama, email, role, dan optional password).
     * Route: PUT /admin/users/{id}
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,user',
        ], [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email ini sudah terdaftar oleh pengguna lain.',
            'password.min'   => 'Password baru minimal harus 6 karakter.',
            'role.required'  => 'Role pengguna wajib dipilih.',
            'role.in'        => 'Role hanya boleh admin atau user.',
        ]);

        $currentUserId = session('user.id');
        $currentUserEmail = session('user.email');

        // Cegah admin mendemote akunnya sendiri jika sedang login
        if (($user->id == $currentUserId || $user->email == $currentUserEmail) && $validated['role'] !== 'admin') {
            return redirect()->route('admin', ['tab' => 'users'])
                ->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri menjadi user saat sedang login.');
        }

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Sinkronkan session jika user mengedit profilnya sendiri
        if ($user->id == $currentUserId || $user->email == $currentUserEmail) {
            session([
                'user.name'  => $user->name,
                'user.email' => $user->email,
                'user.role'  => $user->role,
            ]);
        }

        return redirect()->route('admin', ['tab' => 'users'])
            ->with('success', "Data pengguna {$user->name} berhasil diperbarui!");
    }

    /**
     * Ubah role pengguna (misal dari 'user' ke 'admin' atau sebaliknya).
     * Route: PATCH /admin/users/{id}/role
     */
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $currentUserId = session('user.id');
        $currentUserEmail = session('user.email');

        $targetRole = $request->input('role');
        if (!$targetRole) {
            // Toggle otomatis jika tidak dispesifikasikan
            $targetRole = ($user->role === 'admin') ? 'user' : 'admin';
        }

        if (!in_array($targetRole, ['admin', 'user'])) {
            return redirect()->route('admin', ['tab' => 'users'])
                ->with('error', 'Role tidak valid.');
        }

        // Cegah admin mengubah akunnya sendiri menjadi user
        if (($user->id == $currentUserId || $user->email == $currentUserEmail) && $targetRole === 'user') {
            return redirect()->route('admin', ['tab' => 'users'])
                ->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri menjadi user saat sedang login.');
        }

        // Cegah mendemote admin terakhir
        if ($user->role === 'admin' && $targetRole === 'user' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin', ['tab' => 'users'])
                ->with('error', 'Tidak dapat mengubah role admin terakhir di sistem.');
        }

        $oldRole = $user->role;
        $user->role = $targetRole;
        $user->save();

        return redirect()->route('admin', ['tab' => 'users'])
            ->with('success', "Role {$user->name} berhasil diubah dari {$oldRole} menjadi {$targetRole}!");
    }

    /**
     * Hapus user dari database.
     * Route: DELETE /admin/users/{id}
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $currentUserId = session('user.id');
        $currentUserEmail = session('user.email');

        // Cegah menghapus diri sendiri saat login
        if ($user->id == $currentUserId || $user->email == $currentUserEmail) {
            return redirect()->route('admin', ['tab' => 'users'])
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login.');
        }

        // Cegah menghapus admin terakhir
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin', ['tab' => 'users'])
                ->with('error', 'Tidak dapat menghapus admin terakhir pada sistem.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin', ['tab' => 'users'])
            ->with('success', "Pengguna {$userName} berhasil dihapus dari sistem.");
    }
}
