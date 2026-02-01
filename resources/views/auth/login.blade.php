@extends('layouts.app')

@section('title', 'Spotify - Login')

@section('content')

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        </script>
    @endif

    <section class="flex flex-col lg:flex-row bg-[#121212] text-white min-h-screen">

        <div
            class="banner-container lg:w-1/2 h-80 sm:h-[40vh] md:h-[40vh] lg:h-screen bg-[#25cf60] flex items-center justify-center overflow-hidden">
            <img src="{{ asset('svg/banner_spotify.svg') }}" alt="Spotify Banner"
                class="w-auto h-auto object-cover block" />
        </div>

        <!-- Área do formulário -->
        <div class="form-container flex-1 flex items-center justify-center px-4 py-8 sm:px-8 sm:py-12 lg:py-0 lg:px-12">
            <div class="w-full max-w-md sm:max-w-lg space-y-6 sm:space-y-8">

                <!-- Título -->
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl font-bold text-center flex flex-col justify-center items-center space-y-8 tracking-tight text-white">
                    <img src="{{ asset('svg/min_logo_spotify.svg') }}" alt="Spotify" class="h-8 w-8 mb-2" />
                    {{ __('message.welcome') }}
                </h1>

                <form method="POST" action="{{ route('login') }}" class="space-y-5 sm:space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-zinc-400 mb-1.5">{{ __('message.email') }}</label>
                        <input id="email" name="email" type="email" placeholder="Email@gmail.com"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required value="{{ old('email') }}"
                            class="w-full h-12 px-4 sm:px-5 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#1DB954] focus:ring-2 focus:ring-[#1DB954]/40 focus:outline-none transition text-base" />
                        @error('email') <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Senha -->
                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-zinc-400 mb-1.5">{{ __('message.password') }}</label>
                        <input id="password" name="password" type="password" placeholder="********" required
                            class="w-full h-12 px-4 sm:px-5 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#1DB954] focus:ring-2 focus:ring-[#1DB954]/40 focus:outline-none transition text-base" />
                        @error('password') <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p> @enderror
                        <a href="{{ route('password.request') }}" class="text-[#1DB954] hover:underline font-medium">
                            {{ __('message.forgot_password') }}
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full h-12 bg-[#1DB954] hover:bg-[#1ed760] text-black font-bold rounded-full text-base sm:text-lg transition duration-200 shadow-md active:scale-95 mt-4">
                        {{ __('message.continue') }}
                    </button>

                    <div class="relative my-6 sm:my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-zinc-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-[#121212] text-zinc-400">{{ __('message.or') }}</span>
                        </div>
                    </div>
                </form>

                <form id="auth-google-button" action="{{ route('auth.google') }}">
                    <button type="button" onclick="{ document.getElementById('auth-google-button').submit(); }"
                        class="w-full h-12 flex items-center justify-center gap-3 bg-white hover:bg-zinc-100 text-black font-medium rounded-full transition duration-200 shadow-md active:scale-95 text-base sm:text-lg">
                        <svg class="h-6 w-6" viewBox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.51h5.84c-.25 1.31-.98 2.42-2.07 3.16v2.63h3.35c1.96-1.81 3.09-4.47 3.09-7.25z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.35-2.63c-.98.66-2.23 1.06-3.93 1.06-3.02 0-5.58-2.04-6.49-4.79H.96v2.67C2.77 20.39 6.62 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.51 14.21c-.23-.66-.36-1.37-.36-2.21s.13-1.55.36-2.21V7.34H.96C.35 8.85 0 10.39 0 12s.35 3.15.96 4.66l4.55-2.45z"
                                fill="#FBBC05" />
                            <path
                                d="M12 4.98c1.64 0 3.11.56 4.27 1.66l3.19-3.19C17.46 1.01 14.97 0 12 0 6.62 0 2.77 2.61 0.96 6.34l4.55 2.45C6.42 6.02 8.98 4.98 12 4.98z"
                                fill="#EA4335" />
                        </svg>
                        {{ __('message.continue_with_google') }}
                    </button>
                </form>

                <p class="text-center text-zinc-400 mt-8 sm:mt-10 text-sm sm:text-base">
                    {{ __('message.no_account_yet') }}
                    <a href="{{ route('register') }}"
                        class="text-[#1DB954] hover:underline font-medium">{{ __('message.sign_up') }}
                    </a>
                </p>

            </div>
        </div>

    </section>
@endsection