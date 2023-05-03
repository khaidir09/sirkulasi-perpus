<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan SMK Negeri 1 Amuntai') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-inter antialiased bg-white text-gray-800 tracking-tight">

        <!-- Page wrapper -->
        <div class="flex flex-col min-h-screen overflow-hidden">

            <!-- Site header -->
            <header class="absolute w-full z-30">
                <div class="max-w-6xl mx-auto px-4 sm:px-6">
                    <div class="flex items-center justify-between h-16 md:h-20">

                        <!-- Site branding -->
                        <div class="shrink-0 mr-4">
                            <!-- Logo -->
                            <a class="block group" href="{{ route('home') }}" aria-label="Cruip">
                                <img src="{{ asset('images/logo-gambar.png') }}" alt="" class="h-12">
                            </a>
                        </div>

                        <!-- Desktop navigation -->
                        <nav class="flex grow">

                            <!-- Desktop sign in links -->
                            <ul class="flex grow justify-end flex-wrap items-center">
                                <li>
                                    <a class="font-medium text-gray-600 decoration-blue-500 decoration-2 underline-offset-2 hover:underline px-3 lg:px-5 py-2 flex items-center transition duration-150 ease-in-out" href="{{ route('login') }}">Masuk</a>
                                </li>
                                <li class="ml-3">
                                    <a class="btn-sm text-white bg-blue-500 hover:bg-blue-600 w-full shadow-sm" href="{{ route('register') }}">Daftar Anggota</a>
                                </li>
                            </ul>

                        </nav>

                    </div>
                </div>
            </header>

            <main class="grow">
                {{ $slot }}
            </main>

        </div>

    </body>
</html>
