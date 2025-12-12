<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // ==============================
    // LIST DATA
    // ==============================
    public function index(Request $request)
    {
        $search = $request->input('cari');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.account.index', compact('users'));
    }

    // ==============================
    // FORM TAMBAH
    // ==============================
    public function create()
    {
        return view('admin.account.create');
    }

    // ==============================
    // SIMPAN DATA AKUN
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role'  => 'required|in:admin,customer',
        ]);

        // Generate password otomatis
        $password = strtolower(substr($request->name, 0, 3) . substr($request->email, 0, 3));

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($password),
        ]);

        return redirect()
            ->route('admin.admin.account.data')
            ->with('success', 'Akun berhasil ditambahkan! Password default: <b>' . $password . '</b>');
    }

    // ==============================
    // FORM EDIT
    // ==============================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.account.edit', compact('user'));
    }

    // ==============================
    // UPDATE AKUN
    // ==============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $id,
            'role'     => 'required|in:admin,customer',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.admin.account.data')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    // ==============================
    // DELETE AKUN
    // ==============================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.admin.account.data')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
