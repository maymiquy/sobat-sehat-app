<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-200">
        <nav x-data="{ open: false }" class="bg-white drop-shadow-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-7">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-9 w-auto rounded-full fill-current" />
                            </a>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                {{ __('Beranda') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('kegiatan')" :active="request()->routeIs('kegiatan')">
                                {{ __('Kegiatan & Acara') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <div class="flex items-center">
                        @if (request()->routeIs('kegiatan.search') || request()->routeIs('kegiatan'))
                            <form action="{{ route('kegiatan.search') }}" method="GET"
                                class="hidden relative w-full drop-shadow-md">
                                <input type="text" name="search" placeholder="Cari acara. . ."
                                    value="{{ request()->input('search') }}"
                                    class="appearance-none rounded-md border border-gray-400 border-b hidden pl-8 pr-6 py-2 w-full bg-white text-xs placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                                <button type="submit" class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12"
                                        viewBox="0 0 512 512" class="h-3 w-3 fill-current text-gray-500">
                                        <path
                                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('kegiatan.search') }}" method="GET"
                                class="block relative w-full drop-shadow">
                                <input type="text" name="search" placeholder="Cari acara. . ."
                                    value="{{ request()->input('search') }}"
                                    class="appearance-none rounded-md border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-xs placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                                <button type="submit" class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12"
                                        viewBox="0 0 512 512" class="h-3 w-3 fill-current text-gray-500">
                                        <path
                                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                    </svg>
                                </button>
                            </form>
                        @endif

                        @guest
                            <div class="hidden ps-6 w-full sm:flex sm:items-center sm:ms-6">
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}"
                                        class="font-medium text-gray-400 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Log
                                        in</a>
                                @endif
                                <div class="ml-3 font-light text-gray-400"> | </div>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-3 font-medium text-gray-400 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Register</a>
                                @endif
                            </div>
                        @else
                            <div class="hidden sm:flex sm:items-center sm:ms-6 w-full">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        @if (Auth::user()->role === 'Admin')
                                            <div
                                                class="block h-full w-full px-4 py-2 font-bold text-start text-sm text-gray-900 focus:outline-none transition duration-150 ease-in-out border-b border-gray-200 border-separate">
                                                Logging as: {{ Auth::user()->role }}</div>
                                            <x-dropdown-link :href="route('dashboard')">
                                                {{ __('Dasboard') }}
                                            </x-dropdown-link>
                                        @else
                                            <div
                                                class="block h-full w-full px-4 py-2 font-bold text-start text-sm text-gray-900 focus:outline-none transition duration-150 ease-in-out border-b border-gray-200 border-separate">
                                                Logging as: {{ Auth::user()->role }}</div>
                                        @endif

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endguest

                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Beranda') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('kegiatan')" :active="request()->routeIs('kegiatan')">
                            {{ __('Kegiatan & Acara') }}
                        </x-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    @guest
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            @if (Route::has('login'))
                                <x-responsive-nav-link href="{{ route('login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700">{{ __('Login') }}</x-responsive-nav-link>
                            @endif

                            @if (Route::has('register'))
                                <x-responsive-nav-link href="{{ route('register') }}"
                                    class="block px-4 py-2 text-sm text-gray-700">{{ __('Register') }}</x-responsive-nav-link>
                            @endif
                        @else
                            @if (Auth::user()->role === 'Admin')
                                <div class="px-4">
                                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <x-responsive-nav-link :href="route('dashboard')">
                                        {{ __('Dasboard') }}
                                    </x-responsive-nav-link>
                                @else
                                    <div class="px-4">
                                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                @endguest
        </nav>
    </div>

    <!-- Page Content -->
    <main class="bg-neutral-100">
        {{ $slot }}
    </main>

    <script>
        function showSelectedFileName(event) {
            const input = event.target;
            const fileName = input.files[0].name;
            const fileNameElement = document.getElementById("file-name");
            fileNameElement.textContent = fileName;
        }
    </script>
</body>

</html>
