<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Digite seu email.',
            'email.email' => 'Digite um email válido.',
            'password.required' => 'Digite sua senha.',
        ]);

       if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $usuario = Auth::user();

            if ($usuario->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($usuario->role === 'usuario') {
                return redirect()->route('cliente.dashboard');
            }

            return redirect()->route('home');
        }

        return back()
            ->withErrors([
                'email' => 'Email ou senha incorretos.',
            ])
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
    }
}
