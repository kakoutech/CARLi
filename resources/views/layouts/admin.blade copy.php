<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'App') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

    @include('partials.styles')

    @livewireStyles

</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-full">

        <div class="bg-brand-500 pb-32">

            <nav x-data="{ isMobileOpen: false }" @click.away="isMobileOpen = false" class="bg-brand-700">

                <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">

                    <div class="relative h-16 flex items-center justify-between">

                        <div class="px-2 flex items-center lg:px-0">

                            <div class="flex-shrink-0">

                                <img class="block h-16" src="{{ asset('assets/img/logo-cropped.png') }}" alt="{{ config('app.name', 'App') }}">

                            </div>

                            <div class="hidden lg:block lg:ml-10">

                                <div class="flex space-x-4">

                                    <a href="{{ route('admin.dashboard') }}" class="
                                        @if (request()->is('admin/dashboard'))    
                                            bg-white text-brand-500 rounded-md py-2 px-3 text-sm font-medium
                                        @else 
                                            text-white hover:bg-brand-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium
                                        @endif
                                        "> Dashboard </a>

                                    <a href="{{ route('admin.users') }}" class="
                                        @if (request()->is('admin/users*'))
                                            bg-white text-brand-500 rounded-md py-2 px-3 text-sm font-medium
                                        @else 
                                            text-white hover:bg-brand-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium
                                        @endif
                                        "> Users </a>

                                    <a href="{{ route('admin.pages') }}" class="
                                        @if (request()->is('admin/pages*'))
                                            bg-white text-brand-500 rounded-md py-2 px-3 text-sm font-medium  
                                        @else 
                                            text-white hover:bg-brand-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium
                                        @endif
                                    "> Pages </a>

                                    <a href="{{ route('admin.reflective-journal') }}" class="
                                        @if (request()->is('admin/reflective-journal*'))
                                            bg-white text-brand-500 rounded-md py-2 px-3 text-sm font-medium  
                                        @else 
                                            text-white hover:bg-brand-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium
                                        @endif
                                    "> Reflective Journal </a>

                                    <a href="{{ route('admin.strategy-tools') }}" class="
                                        @if (request()->is('admin/strategy-tool*'))
                                            bg-white text-brand-500 rounded-md py-2 px-3 text-sm font-medium  
                                        @else 
                                            text-white hover:bg-brand-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium
                                        @endif
                                    "> Strategy Tool </a>

                                    <a href="{{ route('admin.tools-and-resources') }}" class="
                                        @if (request()->is('admin/tools-and-resources*'))
                                            bg-white text-brand-500 rounded-md py-2 px-3 text-sm font-medium  
                                        @else 
                                            text-white hover:bg-brand-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium
                                        @endif
                                    "> Tools &amp; Resources </a>

                                </div>

                            </div>

                        </div>

                        <div class="flex lg:hidden">

                            <button @click="isMobileOpen = !isMobileOpen" type="button" class="bg-brand-500 p-2 rounded-md inline-flex items-center justify-center text-white hover:text-white hover:bg-brand-700 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                                <span class="sr-only">Open main menu</span>

                                <svg x-show="!isMobileOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>

                                <svg x-show="isMobileOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                            </button>

                        </div>

                        <div class="hidden lg:block lg:ml-4">

                            <div class="flex items-center">

                                <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="ml-3 relative flex-shrink-0">

                                    <button @click="isOpen = !isOpen" type="button" class="bg-brand-500 rounded-full flex text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">

                                        <span class="sr-only">Open user menu</span>

                                        <img class="rounded-full h-8 w-8" src="{{ auth()->user()->getAvatar() }}" alt="">

                                    </button>

                                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="z-index: 999;" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                                        <a href="{{ route('admin.dashboard.profile') }}" class="hover:bg-gray-100 cursor-pointer block py-2 px-4 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0"> Your Profile </a>

                                        <a onclick="document.getElementById('logout').submit()" class="hover:bg-gray-100 cursor-pointer block py-2 px-4 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2"> Sign out </a>

                                        <form id="logout" method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="lg:hidden" x-show="isMobileOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" id="mobile-menu">

                    <div class="px-2 pt-2 pb-3 space-y-1">

                        <a href="{{ route('admin.dashboard') }}" class="bg-brand-700 text-white block rounded-md py-2 px-3 text-base font-medium" aria-current="page"> Dashboard </a>

                        <a href="{{ route('admin.users') }}" class="text-white hover:bg-brand-700 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium"> Users </a>

                        <a href="{{ route('admin.pages') }}" class="text-white hover:bg-brand-700 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium"> Pages </a>

                        <a href="{{ route('admin.reflective-journal') }}" class="text-white hover:bg-brand-700 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium"> Reflective Journal </a>

                        <a href="{{ route('admin.strategy-tools') }}" class="text-white hover:bg-brand-700 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium"> Strategy Tool </a>

                        <a href="{{ route('admin.tools-and-resources') }}" class="text-white hover:bg-brand-700 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium"> Tools &amp; Resources </a>

                    </div>

                    <div class="pt-4 pb-3 border-t border-gray-100">

                        <div class="px-5 flex items-center">

                            <div class="flex-shrink-0">

                                <img class="rounded-full h-10 w-10" src="{{ auth()->user()->getAvatar() }}" alt="">

                            </div>

                            <div class="ml-3">

                                <div class="text-base font-medium text-white">{{ auth()->user()->getFullName() }}</div>

                                <div class="text-sm font-medium text-gray-300">{{ auth()->user()->getEmail() }}</div>

                            </div>

                        </div>

                        <div class="mt-3 px-2 space-y-1">

                            <a href="{{ route('admin.dashboard.profile') }}" class="cursor-pointer block rounded-md py-2 px-3 text-base font-medium text-white hover:bg-brand-700 hover:bg-opacity-75"> Your Profile </a>

                            <a onclick="document.getElementById('logout').submit()" class="cursor-pointer block rounded-md py-2 px-3 text-base font-medium text-white hover:bg-brand-700 hover:bg-opacity-75"> Sign out </a>

                        </div>

                    </div>

                </div>

            </nav>

            <header class="py-5 md:py-10">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 md:flex justify-between items-center">

                    <div>
                        <h1 class="mb-3 md:mb-0 text-3xl font-bold text-white">@yield('title')</h1>
                        @hasSection('subtitle')
                        <h3 class="text-white">@yield('subtitle')</h3>
                        @endif

                    </div>

                    @yield('actions')

                </div>

            </header>

        </div>

        <main class="-mt-32">

            <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">

                @yield('content')

            </div>

        </main>

        <footer>

            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">

                <div class="border-t border-gray-200 py-8 text-sm text-gray-500 text-center sm:text-left">

                    <span class="block sm:inline">© {{ date('Y') }} CARLi.</span> <span class="block sm:inline">All rights reserved.</span>

                </div>

            </div>

        </footer>

    </div>

    @include('partials.message-bag')

    @livewireScripts

</body>

</html>