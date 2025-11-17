<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $r)
    {
        // Validar datos
        $cred = $r->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar autenticar
        if (Auth::attempt($cred, $r->boolean('remember'))) {
            $r->session()->regenerate();
            // Redirige al catálogo (o a intended si vienes de una ruta protegida)
            return redirect()->intended(route('vehicles.index'));
        }

        // Si falla, vuelve con error y mantiene email
        return back()
            ->withErrors(['email' => 'Credenciales inválidas'])
            ->withInput(['email' => $r->email]);
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('login');
    }
}
