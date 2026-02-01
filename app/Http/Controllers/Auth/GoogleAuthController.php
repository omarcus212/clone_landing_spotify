<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController
{
    /**
     * Redireciona o usuário para o Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Lida com o retorno do Google (callback)
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/home');  // Mude para a rota que você quer após login (ex: perfil ou home)
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),  // Salva o ID do Google para identificar
                    'password' => Hash::make(Str::random(16)),
                    'active' => true
                ]);

                Auth::login($newUser);
                return redirect()->intended('/home');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', __('message.google_login_error'));
        }
    }
}