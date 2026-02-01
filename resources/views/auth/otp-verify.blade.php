@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-black flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 py-12">

            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_RGB_White.png" alt="Spotify"
                    class="h-10 sm:h-12 w-auto" />
            </div>

            <!-- Título -->
            <h1 class="text-3xl sm:text-4xl font-bold text-center text-white tracking-tight">
                {{ __('message.check_your_email') }}
            </h1>

            <p class="text-center text-zinc-400 text-base sm:text-lg mt-3">
                {{ __('message.otp_sent_message') }} {{ session('otp_email') }}. {{ __('message.enter_code_to_activate') }}
            </p>

            <!-- Formulário -->
            <form method="POST" action="{{ route('otp.verify.post') }}" class="mt-8 space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ session('otp_email') }}">

                <!-- Código OTP -->
                <div>
                    <label for="otp"
                        class="block text-sm font-medium text-zinc-300 mb-2">{{ __('message.verification_code') }}</label>
                    <input id="otp" name="otp" type="text" maxlength="6" required autofocus
                        class="w-full h-12 px-4 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#1DB954] focus:ring-2 focus:ring-[#1DB954]/40 focus:outline-none transition text-base text-center tracking-widest" />
                    @error('otp')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botão -->
                <button type="submit"
                    class="w-full py-3.5 bg-[#1DB954] hover:bg-[#1ed760] text-black font-bold rounded-full text-lg transition duration-200 shadow-md active:scale-95">
                    {{ __('message.verify_and_activate') }}
                </button>
            </form>

            <!-- Link para reenviar -->
            <div class="text-center mt-6 text-zinc-400 text-sm">
                {{ __('message.did_not_receive_code') }} <a href="{{ route('otp.verify.post') }}"
                    class="text-[#1DB954] hover:underline">{{ __('message.resend_code') }}</a>
            </div>
        </div>
    </div>
@endsection