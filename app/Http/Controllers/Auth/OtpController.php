<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class OtpController
{
    public function showOtpVerify()
    {
        return view('auth.otp-verify');
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|max:6',
            'email' => 'required|email',
        ]);

        $sessionOtp = session('otp_code');
        $requestEmail = $request->email;

        // Caso a sessão tenha expirado
        if (!$sessionOtp) {
            $user = User::where('email', $requestEmail)->first();

            if ($user && !$user->active) {
                $user->delete();
            }

            return redirect()->route('register')->with('error', 'Sessão expirada. Por favor, registre-se novamente.');
        }

        $sessionEmail = session('otp_email');

        if ($requestEmail === $sessionEmail && $request->otp === $sessionOtp) {
            $user = User::where('email', $sessionEmail)->first();

            if ($user) {
                $user->active = true;
                $user->save();

                session()->forget(['otp_code', 'otp_email']);

                return redirect()->route('login')->with('status', 'Conta ativada com sucesso! Faça login.');
            }
        }

        return back()->withErrors(['otp' => 'Código inválido ou e-mail não corresponde. Tente novamente.']);
    }
}
