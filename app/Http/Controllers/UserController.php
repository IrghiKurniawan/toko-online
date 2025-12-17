<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Halaman login
    public function index()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email:rfc,dns',
                'password' => 'required|min:4',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 4 karakter.',
            ]
        );

        if (Auth::attempt(
            $request->only('email', 'password'),
            $request->remember
        )) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'customer') {
                return redirect()->route('customer.product');
            }

            Auth::logout();

            return redirect('/')->with('error', 'Role user tidak valid.');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // redirect aman ke login page
        return redirect('/')->with('success', 'Anda telah logout.');
    }

    // Halaman register
    public function register()
    {
        return view('register');
    }

    // Proses register
    public function register_user(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required|string|min:4|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.min' => 'Nama minimal 3 karakter.',
                'name.max' => 'Nama maksimal 255 karakter.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',

                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 4 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',

                'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            ]
        );

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
