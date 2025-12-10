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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'customer') {
                return redirect()->route('customer.product');
            }

            // Fallback jika role invalid
            Auth::logout();

            return redirect('/')->with('error', 'Role user tidak valid.');
        }

        return back()->with('error', 'Email atau password salah');
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
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil, silakan wlogin!');
    }
}
