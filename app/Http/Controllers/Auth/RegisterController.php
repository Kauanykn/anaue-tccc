<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'telefone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'min:8'],
        ], [
            'name.required' => 'Digite seu nome.',
            'email.required' => 'Digite seu email.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Esse email já está cadastrado.',
            'telefone.required' => 'Digite seu telefone.',
            'password.required' => 'Digite uma senha.',
            'password.min' => 'A senha precisa ter pelo menos 8 caracteres.',
        ]);

        $usuario = User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'telefone' => $dados['telefone'],
            'password' => Hash::make($dados['password']),
        ]);

        Auth::login($usuario);

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}