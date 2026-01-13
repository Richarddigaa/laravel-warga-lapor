<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Cek jika user memiliki role 'super_admin'
        if ($user->hasRole('super_admin')) {

            // Arahkan ke dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }
        // Jika bukan super_admin, cek apakah user memiliki role 'citizen'
        else if ($user->hasRole('citizen')) {

            // Arahkan ke dashboard citizen
            return redirect()->intended(route('citizen.dashboard'));
        }
        // Jika tidak memiliki kedua role di atas
        else {

            // Logout user secara otomatis
            Auth::logout();

            // Invalidate session dan regenerate token untuk keamanan
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            // Arahkan kembali ke halaman login dengan pesan error
            return redirect('login')->with('error', 'Anda tidak memiliki hak akses yang valid.');
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
