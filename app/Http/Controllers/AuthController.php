<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    use Illuminate\Support\Facades\Auth;

public function login(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    // Debug awal
    dd($credentials);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        dd('Login berhasil', $user);

        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.index');
            case 2:
                return redirect()->route('panitia.index');
            case 3:
                return redirect()->route('keuangan.index');
            case 4:
                return redirect()->route('member.index');
            default:
                return redirect('/');
        }
    }

    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ])->onlyInput('email');
}



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
