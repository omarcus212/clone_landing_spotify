<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Mail;
use Password;
use Str;
use App\Http\Requests\{StoreUserLoginRequest, StoreUserRequest};
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Authenticator;


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
                return back()->with('error', __('message.invalid_credentials'));
            }

            $request->session()->regenerate();

            return redirect()->route('profile');

        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', __('message.login_error'));
        }

    }

    public function showRegister()
    {
        return view('auth/register');
    }

    public function store(StoreUserRequest $request)
    {

        $data = $request->validated();

        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            // // Gera OTP (6 caracteres aleatórios numéricos)
            // $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);  // ex: '123456'

            // // Armazena na sessão (expira automaticamente após o tempo de sessão padrão)
            // session(['otp_code' => $otpCode, 'otp_email' => $data['email']]); // guarda OTP e e-mail para validação

            // // Envia e-mail com OTP
            // Mail::raw("Seu código de verificação é: $otpCode. Ele expira em 10 minutos.", function ($message) use ($data) {
            //     $message->to($data['email'])->subject('Verificação de Registro - Spotify Clone');
            // });

            // // Redireciona para tela de OTP
            return redirect()->route('login')->with('status', __('message.register_success'));

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->with('error', __('message.register_error' . $e->getMessage()));
        }
    }

    public function showForgotPasswordForm()
    {
        return view('auth.reset-password-step-one');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Enviar link de reset (o que você mostrou)
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::INVALID_USER) {
            return back()->withErrors(['email' => __($status)]);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset-password-step-two', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request, $token = null)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout($request);

        return redirect()->route('login');
    }
}
