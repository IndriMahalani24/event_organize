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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();        

            $user = Auth::user();
            dd('Berhasil login', $user);

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('adminList');
                case 'panitia':
                    return redirect()->route('events.index'); // atau route panitia
                case 'keuangan':
                    return redirect()->route('events.index');
                case 'member':
                    return redirect()->route('landing');
                default:
                    abort(403, 'Role tidak dikenali.');
            }

        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
