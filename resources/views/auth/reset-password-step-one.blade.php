@extends('layouts.app')

@section('title', 'Spotify - Redefinir Senha')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-black text-white p-4">
        <!-- Logo -->
        <a href="{{ route('login') }}" class="absolute top-8 left-8">
            <img src="{{ asset('images/banner_notback_spotify.png') }}" alt="Spotify" class="h-10" />
        </a>

        <!-- Reset Box -->
        <div class="bg-[#121212] p-8 sm:p-10 md:p-12 rounded-lg shadow-lg w-full max-w-lg relative">
            <!-- Close button -->
            <a href="{{ route('login') }}" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-bold text-center mb-2">{{ __('message.reset_password') }}</h1>
            <p class="text-center text-gray-400 mb-8 text-sm sm:text-base">
                {{ __('message.reset_password_title') }}<br>
                {{ __('message.reset_password_instruction') }}
            </p>

            <form method="POST" action="{{ url('/forgot-password') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-zinc-400 mb-2">{{ __('message.email') }}</label>
                    <input id="email" name="email" type="email" placeholder="Email@gmail.com"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required value="{{ old('email') }}"
                        class="w-full h-12 px-4 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#1DB954] focus:ring-2 focus:ring-[#1DB954]/40 focus:outline-none transition text-base" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                    <a href="{{ route('login') }}"
                        class="w-full h-12 flex justify-center items-center border-2 border-zinc-400 hover:text-red-500 underline text-white font-bold rounded-sm text-base sm:text-lg transition duration-200 shadow-md active:scale-95 mt-4">
                        {{ __('message.cancel') }}
                    </a>
                    <button type="submit"
                        class="w-full h-12 bg-[#1DB954] hover:bg-[#1ed760] text-black font-bold rounded-sm text-base sm:text-lg transition duration-200 shadow-md active:scale-95 mt-4">
                        {{ __('message.continue') }}
                    </button>

                </div>

            </form>
        </div>
    </div>
@endsection