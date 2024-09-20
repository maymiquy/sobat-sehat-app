<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/jpg" sizes="192x192" href="{{ asset('assets/icon/brand.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 1 })"
        class="z-20 w-full bg-neutral-100 transition-all duration-300 ease-in-out fixed"
        :class="{ 'top-0 drop-shadow-md': scrolled, 'drop-shadow-sm': !scrolled }">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-7">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-10 sm:h-12 w-auto rounded-full fill-current" />
                            </a>
                            @if (request()->routeIs('home'))
                                <h5 class="hidden sm:block font-semibold text-md lg:text-xl text-gray-800 font-sans">
                                    Sobat Sehat
                                </h5>
                            @else
                                <h5 class="font-semibold text-md sm:text-xl text-gray-800 font-sans">Sobat Sehat
                                </h5>
                            @endif
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 md:flex">
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                {{ __('Beranda') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 md:flex">
                            <x-nav-link :href="route('kegiatan')" :active="request()->routeIs('kegiatan')">
                                {{ __('Kegiatan & Acara') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <div class="flex items-center">
                        @if (request()->routeIs('kegiatan.search') || request()->routeIs('kegiatan'))
                        @else
                            <form action="{{ route('kegiatan.search') }}" method="GET"
                                class="relative w-full me-4 sm:me-1 md:me-0 shadow-sm">
                                <input type="text" name="search" placeholder="Cari kegiatan acara. . ."
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
                            <div class="hidden ps-6 w-full md:flex sm:items-center sm:ms-6">
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}"
                                        class="font-medium text-gray-400 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                                        data-ripple-light="true" data-tooltip-target="tooltip-login">Log in</a>
                                @endif
                                <div class="ml-3 font-light text-gray-400"> | </div>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-3 font-medium text-gray-400 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                                        data-ripple-light="true" data-tooltip-target="tooltip-register">Register</a>
                                @endif
                            </div>
                        @else
                            <div class="hidden md:flex sm:items-center sm:ms-6 w-full">
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
                        @if (request()->routeIs('kegiatan'))
                            <div class="absolute -top-96 w-64">
                                <div data-tooltip="tooltip-register" data-tooltip-placement="bottom"
                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                    Register Kontributor Acara
                                </div>
                                <div data-tooltip="tooltip-login" data-tooltip-placement="bottom"
                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                    Login Kontributor Acara
                                </div>
                            </div>
                        @elseif (request()->routeIs('home'))
                            <div class="absolute -top-96 w-[480px]">
                                <div data-tooltip="tooltip-register" data-tooltip-placement="bottom"
                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                    Register Kontributor Acara
                                </div>
                                <div data-tooltip="tooltip-login" data-tooltip-placement="bottom"
                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-gray-300 py-1.5 px-3 font-sans text-sm font-normal text-black focus:outline-none">
                                    Login Kontributor Acara
                                </div>
                            </div>
                        @endif


                        <div class="-me-2 flex items-center md:hidden">
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

                <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
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
    <main class="bg-neutral-100 pb-8 pt-[5rem] md:pb-16 md:pt-24">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-100 drop-shadow-lg">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="#" class="flex items-center">
                        <img src="{{ asset('assets/icon/brand.jpg') }}" class="h-8 me-3" alt="Logo Brand" />
                        <h5 class="self-center text-2xl font-semibold whitespace-nowrap text-gray-700">Sobat Sehat</h5>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase text-gray-700">Follow us</h2>
                        <ul class="text-gray-500 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/maymiquy" class="hover:underline ">Github</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Discord</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase text-gray-700">Legal</h2>
                        <ul class="text-gray-500 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-300 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="#"
                        class="hover:underline">Sobat Sehat™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:htext-gray-900">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:htext-gray-900 ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 21 16">
                            <path
                                d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:htext-gray-900 ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:htext-gray-900 ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

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
