<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Ambil hanya email dan password dari request
        // dd($request->role());
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        // Coba lakukan login
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        // Login sukses: regenerasi session
        $request->session()->regenerate();
        // dd(Auth::user());

        $user = Auth::user(); // Ambil user yang sedang login

        // Ambil ID role dari relasi user->role
        $roleId = $user->role->id ?? null;

        // Arahkan user ke halaman sesuai role
        switch ($roleId) {
            case 1:
                return redirect()->route('adminList');
            case 2:
                return redirect()->route('panitia.event.index');
            case 3:
                return redirect()->route('finance.index');
            case 4:
                return redirect()->route('events.event');
            default:
                // Role tidak dikenali: logout dan kembalikan ke login
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Role tidak dikenali.',
                ]);
        }
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
