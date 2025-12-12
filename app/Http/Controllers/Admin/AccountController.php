<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
            return $query->where('name', 'like', '%'.$search.'%');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,customer',
        ]);

        // Generate password otomatis
        $password = strtolower(substr($request->name, 0, 3).substr($request->email, 0, 3));

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($password),
        ]);

        return redirect()->route('admin.account.data')->with('success', 'Akun berhasil ditambahkan!');
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'role' => 'required|in:admin,customer',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);

        // Jika password dikosongkan → jangan ikut dimasukkan ke update
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']); // hapus biar tidak overwrite
        }

        // Update langsung semua field yang sudah aman
        $user->update($validated);

        return redirect()->route('admin.account.data')->with('success', 'Akun berhasil diperbarui.');
    }

    // ==============================
    // DELETE AKUN
    // ==============================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.account.data')->with('success', 'Akun berhasil dihapus.');
    }
}
