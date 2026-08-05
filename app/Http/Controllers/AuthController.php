<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    // SHOW LOGIN PAGE
    
    public function showLogin()
    {
        return view('auth.login');
    }

    
    // SHOW REGISTER PAGE
    
    public function showRegister()
    {
        return view('auth.register');
    }

        // REGISTER USER
    
    public function register(Request $request)
    {
        // Validasi input register
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,

            // Password wajib di-hash
            'password' => Hash::make($request->password),

            // Register hanya untuk calon siswa
            'role' => 'student'
        ]);

        // Auto login setelah register
        Auth::login($user);

        return redirect('/student/dashboard');
    }

   
    // LOGIN USER
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            // Redirect berdasarkan role
            if ($role == 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($role == 'panitia') {
                return redirect('/panitia/dashboard');
            }

            return redirect('/student/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    
    // LOGOUT
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}