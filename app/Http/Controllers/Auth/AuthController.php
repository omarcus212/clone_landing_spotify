<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\{StoreUserLoginRequest, StoreUserRequest};
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController
{
    public function showLogin()
    {
        return view('auth/login');
    }

    public function login(StoreUserLoginRequest $request)
    {

        $credentials = $request->validated();

        try {

            if (!Auth::attempt($credentials)) {
                return back()->with('error', 'E-mail ou senha inválidos');
            }

            $request->session()->regenerate();

            return redirect()->route('profile');

        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao logar. Tente novamente.');
        }

    }

    public function showRegister()
    {
        return view('auth/register');
    }

    public function register(StoreUserRequest $request)
    {

        $data = $request->validated();

        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            return redirect()->route('login');

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->with('error', 'Erro ao criar conta. Tente novamente.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // mata a sessão
        $request->session()->regenerateToken(); // segurança CSRF

        return redirect()->route('login');
    }
}
