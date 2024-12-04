<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('assets/css/owlcarousel/owl.carousel.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/owlcarousel/owl.theme.default.min.css') }}">

    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

    @include('partials.styles')

    @livewireStyles

    @laravelPWA

</head>

<body class="font-sans antialiased">

    <div class="font-sans text-gray-900 antialiased">

        <div class="flex items-center justify-between mb-4 shadow-md fixed top-0 w-full bg-white" style="z-index: 999;">

            <div class=" text-lg pl-4">

                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo-cropped.png') }}" class="logo logo-small h-12" />
                </a>

            </div>

            <div class="py-4 text-lg">

                @yield('head')

            </div>

            <div class="py-2 text-lg pr-4">

                <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="h-8 w-8 rounded-full overflow-hidden bg-gray-100 mx-4">

                    <div @click="isOpen = !isOpen">
                        @if (auth()->user() && auth()->user()->avatar_path)

                            <img src="{{ auth()->user()->avatar() }}" class="h-full w-full">

                        @else

                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">

                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />

                            </svg>

                        @endif
                    </div>

                    <ul x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="origin-top-right absolute right-0 mr-6 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none py-2" style="z-index: 999;" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                                    
                        <li class="text-gray-900 cursor-default select-none relative" id="listbox-option-0" role="option">
                    
                            <a href="{{ route('profile') }}" class="text-right font-normal block truncate hover:bg-slate-200 py-1 px-4"> My Profile </a>
                    
                        </li>

                        <li class="text-gray-900 cursor-default select-none relative" id="listbox-option-0" role="option">
                    
                            <a onclick="document.getElementById('logout').submit();" href="#" class="text-right font-normal block truncate hover:bg-slate-200 py-1 px-4"> Log Out </a>
                    
                            <form id="logout" method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                            </form>

                        </li>
                    
                    </ul>

                </div>

            </div>

        </div>

        <div style="margin-top: 90px;">
            
            @yield('content')

        </div>

        <div class="shadow-md border-gray-300 fixed bottom-0 w-full bg-white" style="z-index: 999; box-shadow: 0 4px 6px 6px rgb(0 0 0 / 0.1), 0 2px 4px -5px rgb(0 0 0 / 0.1);">

            <div class="flex items-center justify-between max-w-2xl py-2 mx-auto px-4">

                <a href="{{ route('assessment-hub.personality-assessment') }}">

                    <img src="{{ asset('assets/img/personality-assessment.png') }}" alt="Personality Assessment" class="h-12" />

                </a>

                <a href="{{ route('reflective-journal') }}">

                    <img src="{{ asset('assets/img/reflective-journal.png') }}" alt="Reflective Journal" class="h-12" />

                </a>

                <a href="{{ route('strategy-tools') }}">
                
                    <img src="{{ asset('assets/img/strategies-tools.png') }}" alt="Strategies and Tools" class="h-12" />
                
                </a>
                
                <a href="{{ route('tools-and-resources') }}">
                
                    <img src="{{ asset('assets/img/tools-and-resources.png') }}" alt="Tools and Resources" class="h-12" />
                
                </a>
                
                <a href="{{ route('assessment-hub') }}">
                
                    <img src="{{ asset('assets/img/assessment-hub.png') }}" alt="Assessment Hub" class="h-12" />
                
                </a>

            </div>
        
        </div>

    </div>

    @include('partials.footer')

    @livewireScripts

    <script src="{{ asset('assets/js/jquery-3.6.4.slim.min.js') }}"></script>

    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.min.js') }}"></script>

    @stack('javascript')

</body>

</html>