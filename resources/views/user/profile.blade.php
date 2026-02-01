@extends('layouts.app')

@section('title', 'Spotify - Home')

@section('content')

    @if (session(key: 'error'))
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

    @if (session(key: 'status'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('status') }}',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        </script>
    @endif


    <section class="w-screen min-h-screen bg-[#25CF60] flex justify-center items-center px-3 sm:px-4 md:px-6 py-6 md:py-0">

        <span class="w-[98%] m-auto p-2 flex justify-between items-center absolute top-1">
            <img src="{{ asset('images/long_logo_spotify.png') }}" class="md:w-34" alt="Spotify Banner">

            <button id="lang" data-lang-url="{{ route('set.language') }}"
                class="bg-[#121212] text-white hover:cursor-pointer md:w-12 w-34 h-8 hover:bg-black/60 px-4 py-1.5 rounded-full text-sm font-medium transition">

            </button>
        </span>

        <div
            class="bg-[#121212] w-[80vw] h-auto md:h-[80vh] overflow-hidden flex flex-col rounded-xl md:rounded-2xl shadow-2xl z-10 mt-16 sm:mt-20 md:mt-0">

            <span>
                <div class="w-full h-sm object-cove inset-0 transition-opacity duration-700 ease-in-out"></div>

                <img src="{{ asset('images/banner_music_profile.png') }}" alt="Spotify Banner"
                    class="w-full h-26 object-cover transition-opacity duration-700 ease-in-out opacity-0"
                    onload="this.classList.remove('opacity-0'); this.classList.add('opacity-100')" />
            </span>

            <div class="flex flex-col md:flex-row sm:flex-row flex-1 min-h-0">
                <div
                    class="w-1/2 md:w-1/2 sm:w-1/2 h-auto md:h-full flex flex-col space-y-5 sm:space-y-6 md:space-y-7 h-full flex flex-col relative md:h-full p-4 sm:p-6 md:p-8 lg:p-10 overflow-y-auto scrollbar-visible scrollbar-thin scrollbar-thumb-[#1E1E1E] scrollbar-track-[#121212]">
                    <form action="{{route('profile.update')}}" method="post" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div
                            class="w-full px-4 mt-[-10px] sm:px-6 md:px-8 py-5 sm:py-6 md:py-8 border-b border-zinc-800/80 bg-gradient-to-b from-[#1E1E1E] to-[#121212]">
                            <div class="max-w-3xl mx-auto flex  sm:flex-col items-center justify-between gap-6 sm:gap-8">
                                <div class="flex items-center gap-4 sm:gap-6 sm:flex-col">
                                    <div class="relative sm:flex-col">
                                        <div
                                            class="w-20 h-20 sm:w-24 sm:h-24 sm:flex-col rounded-full bg-[#25CF60] flex items-center justify-center sm:items-center sm:justify-center shadow-lg shadow-[#25CF60]/30">
                                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-black" viewBox="0 0 293 293"
                                                fill="currentColor">
                                                <!-- Logo Spotify oficial (path simplificado) -->
                                                <path
                                                    d="M146.5 0C65.8 0 0 65.8 0 146.5S65.8 293 146.5 293 293 227.2 293 146.5 227.2 0 146.5 0zm70.4 211.4c-2.7 4-8 5.3-12 2.6-32.9-20.2-74.3-24.8-123.1-13.6-4.8 1.1-9.9-1.9-11-6.7-1.1-4.8 1.9-9.9 6.7-11 53.6-12.4 100.3-7.3 138.1 15.9 4 2.7 5.3 8 2.6 12zm18.7-41.3c-3.4 5.5-10.6 7.3-16 3.9-37.5-23-94.7-28-139.3-15.3-5.8 1.6-12-1.5-13.6-7.3-1.6-5.8 1.5-12 7.3-13.6 50.5-14 113.2-8.3 156.3 17.5 5.4 3.4 7.2 10.6 3.9 16zm1.6-42.6c-45-26.7-119.3-29.1-162.2-16.1-6.9 2.1-14.3-1.8-16.4-8.7-2.1-6.9 1.8-14.3 8.7-16.4 49.9-15 130.6-12.2 181.7 17.8 6.2 3.7 8.2 11.6 4.5 17.8-3.7 6.2-11.6 8.2-17.8 4.5z" />
                                            </svg>
                                        </div>

                                        <div
                                            class="absolute inset-0 rounded-full items-center justify-center bg-gradient-to-br  from-[#25CF60] via-[#1DB954] to-[#25CF60] opacity-30 blur-xl -z-10">
                                        </div>
                                    </div>

                                    <div class="sm:flex-col">
                                        <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ __('message.basic') }}
                                        </h3>
                                        <p class="text-zinc-400 text-sm sm:text-base">{{ __('message.current_plan') }} </p>
                                    </div>
                                </div>

                                <div class="flex flex-col items-center sm:items-center gap-2 sm:gap-3">
                                    <span
                                        class="px-4 py-1.5 bg-[#25CF60]/20 text-[#25CF60] text-sm sm:text-base font-medium rounded-full border border-[#25CF60]/40">
                                        {{ __('message.active') }}
                                    </span>
                                    <a href="https://www.spotify.com/br-pt/premium/"
                                        class="text-[#1DB954] hover:text-[#1ed760] text-sm sm:text-base font-medium underline transition">
                                        {{ __('message.view_plans_or_upgrade') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Nome -->
                        <div class="w-full flex flex-col space-y-1.5 sm:space-y-2 md:space-y-3">
                            <span class="w-full flex justify-between items-center">
                                <label for="name"
                                    class="block text-sm sm:text-base font-medium text-zinc-400">{{ __('message.name') }}</label>
                                <button type="button" id="btn_name" data-target="name"
                                    class="p-1.5 sm:p-2 rounded-md bg-zinc-800 hover:bg-zinc-700 transition text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#1DB954]/50">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                    </svg>
                                </button>
                            </span>
                            <input id="name" name="name" type="text" disabled required
                                value="{{ old('name', $user->name) }}"
                                class="w-full h-10 sm:h-11 md:h-12 px-3 sm:px-4 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#1DB954] focus:ring-2 focus:ring-[#1DB954]/40 focus:outline-none transition text-sm sm:text-base" />
                        </div>

                        <!-- Email -->
                        <div class="w-full flex flex-col space-y-1.5 sm:space-y-2 md:space-y-3">
                            <span class="w-full flex justify-between items-center">
                                <label for="email"
                                    class="block text-sm sm:text-base font-medium text-zinc-400">{{ __('message.email') }}</label>
                                <button type="button" id="btn_email" data-target="email"
                                    class="p-1.5 sm:p-2 rounded-md bg-zinc-800 hover:bg-zinc-700 transition text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#1DB954]/50">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                    </svg>
                                </button>
                            </span>
                            <input id="email" name="email" type="email" disabled required
                                value="{{ old('email', $user->email) }}"
                                class="w-full h-10 sm:h-11 md:h-12 px-3 sm:px-4 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#1DB954] focus:ring-2 focus:ring-[#1DB954]/40 focus:outline-none transition text-sm sm:text-base" />
                        </div>

                        <!-- Senha -->
                        <div class="w-full flex flex-col space-y-1.5 sm:space-y-2 md:space-y-3">
                            <label for="password"
                                class="block text-sm sm:text-base font-medium text-zinc-400">{{ __('message.password') }}</label>
                            <input id="password" disabled name="password" type="password" required
                                autocomplete="new-password" placeholder="************"
                                class="w-full h-10 sm:h-11 md:h-12 px-3 sm:px-4 bg-zinc-900 border border-zinc-700 rounded-md text-white placeholder-zinc-500 focus:border-[#555151] focus:ring-2 focus:ring-[#555151]/40 focus:outline-none transition text-sm sm:text-base disabled:bg-zinc-800 disabled:border-zinc-700 disabled:text-zinc-500 disabled:cursor-not-allowed disabled:opacity-70" />
                            @error('password') <p class="mt-1 text-xs sm:text-sm text-red-500">{{ $message }}</p> @enderror

                        </div>
                    </form>

                    <!-- Formulário escondido que envia o POST -->
                    <form id="reset-form" method="POST" action="{{ route('profile.reset-password') }}"
                        class="inline  mt-[-15px]">
                        @csrf

                        <button type="button" onclick="{ document.getElementById('reset-form').submit(); }"
                            class="text-green-400 hover:text-green-300 underline decoration-green-400/70 hover:decoration-green-300 text-sm sm:text-base transition">
                            {{ __('message.reset_password') }}
                        </button>
                    </form>

                    <div class="flex flex-col items-center gap-4 sm:gap-5 mt-2 sm:mt-4">
                        <form id="deleteAccountForm" action="{{ route('profile.deactivate') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" id="btnDeleteAccount"
                                class="text-red-400 hover:text-red-300 underline decoration-red-400/70 hover:decoration-red-300 text-sm sm:text-base transition">
                                {{ __('message.delete_account') }}
                            </button>
                        </form>

                        <a href="{{ route('logout') }}"
                            class="w-full sm:w-3/5 md:w-4/5 h-11 sm:h-12 bg-[#1DB954] flex text-white justify-center items-center hover:bg-[#1ed760] font-bold rounded-full text-sm sm:text-base md:text-lg transition duration-200 shadow-md active:scale-95">
                            {{ __('message.logout') }}
                        </a>
                    </div>
                </div>

                <!-- Lista lateral (direita) -->
                <div
                    class="w-full md:w-1/2 h-full bg-[#1E1E1E] flex flex-col overflow-hidden border-t md:border-t-0 md:border-l border-zinc-800">

                    <div class="px-4 sm:px-5 md:px-6 py-4 sm:py-5 border-b border-zinc-700">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-white">{{ __('message.trending_now') }}
                        </h3>
                    </div>

                    <div
                        class="flex-1 overflow-y-auto scrollbar-visible scrollbar-thin scrollbar-thumb-[#1E1E1E] scrollbar-track-[#121212] space-y-1.5 sm:space-y-2 px-2 sm:px-3 md:px-4 py-3 sm:py-4">
                        @foreach ($musics as $index => $music)
                            <div
                                class="flex items-center gap-3 sm:gap-4 px-3 sm:px-4 py-2.5 sm:py-3 bg-[#121212] hover:bg-zinc-800/80 rounded-lg transition duration-200">
                                <span
                                    class="text-base sm:text-lg font-bold text-gray-300 w-6 sm:w-7 text-right">{{ $index + 1}}</span>
                                <div class="w-10 sm:w-12 h-10 sm:h-12 rounded-md overflow-hidden flex-shrink-0">
                                    <img src={{ !empty($music['cover']) ? $music['cover'] : 'https://i.pinimg.com/736x/ab/73/c2/ab73c28972f7231ef74caa37f0f0e304.jpg' }} alt="Capa"
                                        class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm sm:text-base font-medium text-white truncate">{{ $music['title'] }}</p>
                                    <p class="text-xs sm:text-sm text-gray-400 truncate">{{ $music['artist'] }}</p>
                                </div>
                                <div class="text-right text-xs sm:text-sm font-medium text-gray-300 whitespace-nowrap">
                                    2,5M
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    @vite('resources/js/user/profile.js')
@endsection