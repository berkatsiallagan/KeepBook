<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)
                    ->where('password', md5($request->password))
                    ->first();

        if ($user) {
            Session::put('user_id', $user->id);
            Session::put('username', $user->username);
            Session::put('nama', $user->nama);
            Session::put('role', $user->role);

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/client/dashboard');
            }
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'nama' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'nama' => $request->nama,
            'role' => 'client'
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}