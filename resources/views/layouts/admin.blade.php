<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>{{ config('app.name', 'App') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="{{ asset('assets/css/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">

    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />

    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

    @include('partials.styles')

    <script src="{{ asset('assets/js/jquery-3.6.4.slim.min.js') }}"></script>

    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.min.js') }}"></script>

    @livewireStyles


    @laravelPWA

</head>

<body class="text-gray-600">

    <div class="wrapper bg-body-100 overflow-x-hidden dark:bg-gray-900 dark:bg-opacity-40" x-data="{ open: false }">

        <nav :class="{ 'w-64 md:w-0': open, 'w-0 md:w-64': !(open) }" aria-expanded="false"
            class="fixed h-screen w-0 bg-white shadow-sm transition-all duration-500 ease-in-out dark:bg-gray-800 md:w-64"
            id="sidebar-menu" x-bind:aria-expanded="open" x-description="Mobile menu">

            <div class="scrollbars h-full overflow-y-auto border-r">

                <div class="mh-18 text-center">

                    <a class="relative" href="#">

                        <img class="mx-auto" src="{{ asset('assets/img/logo-cropped.png') }}" style="height: 75px;" />

                    </a>

                </div>

                <ul class="float-none mt-8 flex w-full flex-col pl-1.5 font-medium" id="side-menu">

                    @foreach (getMenus() as $menu_item)
                        <li class="relative" x-data="{ menu_open: '{{ $menu_item['is_route'] ? 'true' : 'false' }}' }">

                            <a @click="menu_open !== 'true' ? menu_open = 'true' : menu_open = 'false'"
                                :class="{ 'text-brand-500 dark:text-gray-300': menu_open == 'true' }"
                                class="@if ($menu_item['is_route']) text-brand-500 @endif toggle-submenu hover:text-brand-500 block py-2.5 px-6 dark:hover:text-gray-300"
                                href="{{ $menu_item['has_children'] ? 'javascript:;' : $menu_item['route'] }}">

                                <svg class="inline-block h-5 w-5" fill="none" stroke-width="1.5"
                                    stroke="currentColor" style="position: relative; top: -3px; left: -4px;"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    @if ($menu_item['icon'] == 'home')
                                        <path
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'learners')
                                        <path
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'trainers')
                                        <path
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'virtual-classes')
                                        <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'classes')
                                        <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'employers')
                                        <path
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'admins')
                                        <path
                                            d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'journal')
                                        <path
                                            d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'certificates')
                                        <path
                                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'cms')
                                        <path
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'tools')
                                        <path
                                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'assessments')
                                        <path
                                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'tests')
                                        <path
                                            d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'courses')
                                        <path
                                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @elseif ($menu_item['icon'] == 'badges')
                                        <path
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    @endif
                                </svg>

                                <span>{{ $menu_item['name'] }}</span>

                                @if ($menu_item['has_children'])
                                    <span class="inline-block ltr:float-right rtl:float-left">
                                        <svg :class="{
                                            'rotate-0': menu_open == 'true',
                                            'ltr:-rotate-90 rtl:rotate-90': menu_open == 'false'
                                        }"
                                            class="bi bi-chevron-down mt-1.5 rotate-0 transform transition duration-300"
                                            fill="currentColor" height=".8rem" viewBox="0 0 16 16" width=".8rem"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                                                fill-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                @endif
                            </a>

                            @if ($menu_item['has_children'])
                                <ul class="top-full z-50 mb-1 rounded rounded-t-none py-0.5 font-normal ltr:pl-7 ltr:text-left rtl:pr-7 rtl:text-right"
                                    x-show="menu_open == 'true'"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter="transition-all duration-200 ease-out">

                                    @foreach ($menu_item['children'] as $child_item)
                                        <li class="relative">

                                            <a class="@if ($child_item['is_route']) text-brand-500 @endif hover:text-brand-500 clear-both block w-full whitespace-nowrap py-2 px-6 dark:hover:text-gray-300"
                                                href="{{ $child_item['route'] }}">

                                                <svg class="inline-block h-4 w-4" fill="none" stroke-width="1.5"
                                                    stroke="currentColor"
                                                    style="position: relative; top: -2px; left: -4px;"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"
                                                        stroke-linecap="round" stroke-linejoin="round" />

                                                </svg>

                                                {{ $child_item['name'] }}

                                            </a>

                                        </li>
                                    @endforeach

                                </ul>
                            @endif

                        </li>
                    @endforeach


                </ul>

            </div>

        </nav>

        <div :class="{
            'ltr:ml-64 ltr:-mr-64 md:ltr:ml-0 ml-64 rtl:-ml-64 md:rtl:mr-0 md:rtl:ml-0': open,
            'ltr:ml-0 ltr:mr-0 md:ltr:ml-64 rtl:mr-0 rtl:ml-0 md:rtl:mr-64':
                !(open)
        }"
            aria-expanded="false"
            class="flex flex min-h-screen flex-col flex-col transition-all duration-500 ease-in-out ltr:ml-0 ltr:mr-0 rtl:mr-0 rtl:ml-0 md:ltr:ml-64 md:rtl:mr-64"
            x-bind:aria-expanded="open">

            <nav :class="{
                'ltr:left-64 ltr:-right-64 md:ltr:left-0 md:ltr:right-0 rtl:right-64 rtl:-left-64 md:rtl:right-0 md:rtl:left-0': open,
                'ltr:left-0 ltr:right-0 md:ltr:left-64 rtl:right-0 rtl:left-0 md:rtl:right-64':
                    !(open)
            }"
                class="fixed z-50 mt-0 flex flex-row flex-nowrap items-center justify-between bg-white py-2 px-6 shadow-sm transition-all duration-500 ease-in-out ltr:left-0 ltr:right-0 rtl:right-0 rtl:left-0 dark:bg-gray-800 md:ltr:left-64 md:rtl:right-64"
                id="desktop-menu">

                <button @click="open = !open" aria-controls="sidebar-menu" aria-expanded="false"
                    class="inline-flex items-center justify-center text-gray-800 hover:text-gray-600 focus:outline-none focus:ring-0 dark:text-gray-300 dark:hover:text-gray-200"
                    id="navbartoggle" type="button" x-bind:aria-expanded="open.toString()">

                    <span class="sr-only">Mobile menu</span>

                    <svg :class="{ 'block': open, 'hidden': !(open) }" class="hidden h-8 w-8" fill="currentColor"
                        viewBox="0 0 16 16" x-description="Icon open" x-state:off="Menu closed"
                        x-state:on="Menu open" xmlns="http://www.w3.org/2000/svg">
                        <path class="hidden md:block"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                            fill-rule="evenodd"></path>
                        <path class="md:hidden"
                            d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                        </path>
                    </svg>

                    <svg :class="{ 'hidden': open, 'block': !(open) }" class="block h-8 w-8" fill="currentColor"
                        viewBox="0 0 16 16" x-description="Icon closed" x-state:off="Menu closed"
                        x-state:on="Menu open" xmlns="http://www.w3.org/2000/svg">
                        <path class="md:hidden"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                            fill-rule="evenodd"></path>
                        <path class="hidden md:block"
                            d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                        </path>
                    </svg>

                </button>

                <!--
                    <form class="mx-5 hidden sm:inline-block md:hidden lg:inline-block">
                        <div class="relative flex w-full flex-wrap items-stretch">
                            <input aria-label="Search" class="relative max-w-full flex-shrink flex-grow overflow-x-auto border border-gray-100 bg-gray-100 py-2 px-4 text-sm leading-5 text-gray-800 focus:border-gray-200 focus:outline-none focus:ring-0 ltr:rounded-l rtl:rounded-r dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:focus:border-gray-600" placeholder="Search…" type="text">
                            <div class="-mr-px flex">
                                <button class="border-brand-500 bg-brand-500 hover:border-brand-600 hover:bg-brand-600 focus:border-brand-600 focus:bg-brand-600 flex items-center border py-2 px-4 leading-5 text-gray-100 hover:text-white hover:ring-0 focus:outline-none focus:ring-0 ltr:-ml-1 ltr:rounded-r rtl:-mr-1 rtl:rounded-l" type="button">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" x2="16.65" y1="21" y2="16.65"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                -->

                <ul class="mt-2 flex ltr:ml-auto rtl:mr-auto">


                    <li class="relative">

                        <a class="flex rounded-full py-3 px-4 text-sm focus:outline-none" href="/">

                            <div class="relative inline-block">

                                <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                    style="    width: 1.7rem;
    height: 1.7rem;
    position: relative;
    top: -2px;
}"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </div>

                        </a>

                    </li>

                    <!-- messages -->
                    <li class="relative" x-data="{ open: false }">

                        {{-- <a href="javascript:;" class="py-3 px-4 flex text-sm rounded-full focus:outline-none" id="messages" @click="open = ! open"> --}}
                        <a class="flex rounded-full py-3 px-4 text-sm focus:outline-none"
                            href="{{ route('dashboard.messaging') }}" id="messages">

                            <div class="relative inline-block">

                                <svg class="bi bi-envelope h-6 w-6" fill="currentColor" viewBox="0 0 16 16"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z">
                                    </path>

                                </svg>

                                @if (auth()->user()->getUnreadMessageCount())
                                    <span
                                        class="absolute -top-2 flex justify-center rounded-full bg-pink-500 px-1 text-center text-xs text-white ltr:-right-1 rtl:-left-1"><span
                                            class="align-self-center">{{ auth()->user()->getUnreadMessageCount() }}</span></span>
                                @endif

                            </div>

                        </a>

                        {{--
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition-all duration-200 ease-out" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition-all duration-200 ease-in" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute ltr:-right-36 md:ltr:right-0 rtl:-left-36 md:rtl:left-0 rounded top-full z-50 py-0.5 ltr:text-left rtl:text-right bg-white dark:bg-gray-800 border dark:border-gray-700 shadow-md" style="display: none; width: 400px!important;">

                            <div class="p-3 font-normal border-b border-gray-200 dark:border-gray-700">

                                <div class="relative">

                                    <div class="font-bold">Messages</div>

                                </div>

                            </div>

                            <div class="max-h-60 overflow-y-auto scrollbars show">

                                @foreach ([[], [], [], []] as $message)
                                    <a href="#">
                                        <div class="flex flex-wrap flex-row items-center border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:bg-opacity-40 dark:hover:bg-opacity-20 py-2 hover:bg-gray-100 bg-gray-50">
                                            <div class="flex-shrink max-w-full px-2 w-1/4 text-center">
                                                <div class="relative">
                                                    <img src="{{ auth()->user()->getAvatar() }}" class="h-10 w-10 rounded-full mx-auto" alt="Avatar">
                                                    <span title="online" class="flex justify-center absolute -bottom-0.5 ltr:right-2 rtl:left-2 text-center bg-green-500 border border-white w-3 h-3 rounded-full"></span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink max-w-full px-2 w-3/4">
                                                <div class="text-sm font-bold">Lorem Ipsum</div>
                                                <div class="text-gray-500 text-sm mt-1">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat architecto eligendi.</div>
                                                <div class="text-gray-500 text-sm mt-1">12m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>

                            <div class="p-3 text-center font-normal">

                                <a href="{{ route('dashboard.messaging') }}" class="hover:underline">Show all Messages</a>

                            </div>

                        </div>
                        --}}

                    </li>

                    <!-- notification -->
                    <li class="relative" x-data="{ open: false }">

                        <a @click="open = ! open" class="flex rounded-full py-3 px-4 text-sm focus:outline-none"
                            href="javascript:;" id="notify">

                            <div class="relative inline-block">

                                <svg class="bi bi-bell h-6 w-6" fill="currentColor" viewBox="0 0 16 16"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z">
                                    </path>

                                </svg>

                                @if (auth()->user()->getNotificationCount())
                                    <span
                                        class="absolute -top-2 flex justify-center rounded-full bg-pink-500 px-1 text-center text-xs text-white ltr:-right-1 rtl:-left-1"><span
                                            class="align-self-center">{{ auth()->user()->getNotificationCount() }}</span></span>
                                @endif

                            </div>

                        </a>

                        <div @click.away="open = false"
                            class="absolute top-full z-50 origin-top-right rounded border bg-white py-0.5 shadow-md ltr:right-0 ltr:text-left rtl:left-0 rtl:text-right dark:border-gray-700 dark:bg-gray-800"
                            style="display: none; width: 400px!important;" x-show="open"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter="transition-all duration-200 ease-out"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave="transition-all duration-200 ease-in">

                            <div class="border-b border-gray-200 p-3 font-normal dark:border-gray-700">

                                <div class="relative">

                                    <div class="font-bold">Notifications</div>

                                </div>

                            </div>

                            <div class="scrollbars show max-h-60 overflow-y-auto">

                                @if (auth()->user()->notifications()->count())

                                    @foreach (auth()->user()->notifications()->latest()->limit(5)->get() as $notification)
                                        @php $type = explode('\\', $notification->type); @endphp

                                        @includeIf('dashboard.notifications.types.' . $type[2], [
                                            'size' => 'small',
                                            'hide_dismiss' => true,
                                        ])
                                    @endforeach
                                @else
                                    <div class="m-2 rounded bg-gray-200 p-5 text-center">No Notifications Found.</div>

                                @endif

                            </div>

                            <div class="p-3 text-center font-normal">

                                <a class="hover:underline" href="{{ route('dashboard.notifications') }}">Show all
                                    Notifications</a>

                            </div>

                        </div>

                    </li>

                    <li class="relative" x-data="{ open: false }">

                        <a @click="open = ! open" class="flex rounded-full px-3 text-sm focus:outline-none"
                            href="javascript:;" id="user-menu-button">

                            <div class="relative">

                                <img alt="avatar"
                                    class="border-brand-700 bg-brand-700 h-10 w-10 rounded-full border"
                                    src="{{ auth()->user()->getAvatar() }}">

                                <span
                                    class="absolute -bottom-0.5 flex h-3 w-3 justify-center rounded-full border border-white bg-green-500 text-center ltr:right-1 rtl:left-1"
                                    title="online"></span>

                            </div>

                            <div class="text-md ml-3 hidden self-center font-bold md:block">

                                <div class="text-md">
                                    {{ auth()->user()->getFullName() }} ({{ auth()->user()->id }})
                                </div>

                                <div
                                    class="inline-block rounded border border-blue-400 bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800 dark:bg-gray-700 dark:text-blue-400">
                                    {{ auth()->user()->getPointsTotal() }} Points</div>

                            </div>

                        </a>

                        <ul @click.away="open = false"
                            class="absolute top-full z-50 origin-top-right rounded border bg-white py-0.5 shadow-md ltr:right-0 ltr:text-left rtl:left-0 rtl:text-right dark:border-gray-700 dark:bg-gray-800"
                            style="min-width:18rem;display: none;" x-show="open"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter="transition-all duration-200 ease-out"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave="transition-all duration-200 ease-in">

                            <li class="relative">

                                <div class="-mx-4 flex flex-row flex-wrap items-center px-3 py-4">

                                    <div class="w-24 max-w-full flex-shrink px-4">

                                        <img alt="{{ auth()->user()->getFullName() }}"
                                            class="mx-auto h-10 w-10 rounded-full"
                                            src="{{ auth()->user()->getAvatar() }}">

                                    </div>

                                    <div class="w-2/3 max-w-full flex-shrink px-4 ltr:pl-1 rtl:pr-1">

                                        <div class="font-bold">

                                            <a class="hover:text-brand-500 text-lg text-gray-800 dark:text-gray-300"
                                                href="{{ route('dashboard.profile') }}">{{ auth()->user()->getFullName() }}</a>

                                        </div>

                                        <div class="text-gray mt-1 text-sm">{{ auth()->user()->getDisplayRole() }}
                                        </div>

                                    </div>

                                </div>

                            </li>

                            <li class="relative">

                                <hr class="my-0 border-t border-gray-200 dark:border-gray-700">

                            </li>

                            <li class="relative">

                                <a class="hover:text-brand-500 clear-both block w-full whitespace-nowrap py-2 px-6"
                                    href="{{ route('dashboard.profile') }}">

                                    <svg class="bi bi-gear inline h-4 w-4 ltr:mr-2 rtl:ml-2" fill="currentColor"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z">
                                        </path>
                                        <path
                                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z">
                                        </path>
                                    </svg>

                                    My Profile

                                </a>

                            </li>

                            <li class="relative">

                                <hr class="my-0 border-t border-gray-200 dark:border-gray-700">

                            </li>

                            <li class="relative">

                                <a class="hover:text-brand-500 clear-both block w-full whitespace-nowrap py-2 px-6"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout').submit()">

                                    <svg class="bi bi-box-arrow-in-right inline h-4 w-4 ltr:mr-2 rtl:ml-2"
                                        fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"
                                            fill-rule="evenodd"></path>
                                        <path
                                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>

                                    Sign out

                                </a>

                                <form action="{{ route('logout') }}" class="inline" id="logout" method="POST">
                                    @csrf
                                </form>

                            </li>

                        </ul>

                    </li>

                </ul>

            </nav>

            <main class="-mt-2 flex-grow pt-20">

                <div class="p-10">

                    <header>
                        @hasSection('breadcrumbs')
                            <div class="text-sm leading-none">@yield('breadcrumbs')</div>
                        @endif

                        @hasSection('title')
                            <div class="mt-2 mb-8 text-2xl font-bold leading-none">@yield('title')</div>
                        @endif
                    </header>

                    @yield('content')

                </div>

            </main>

            <footer class="bg-white p-6 shadow-sm dark:bg-gray-800">

                <div class="mx-auto">

                    <div class="-mx-4 flex flex-row flex-wrap">

                        <div
                            class="w-full max-w-full flex-shrink px-4 text-center md:w-1/2 md:ltr:text-left md:rtl:text-right">

                            <ul class="ltr:pl-0 rtl:pr-0">

                                <li class="inline-block ltr:mr-3 rtl:ml-3">

                                    <a class="hover:text-brand-500" href="#">Link</a>

                                </li>

                                <li class="inline-block ltr:mr-3 rtl:ml-3">

                                    <a class="hover:text-brand-500" href="#">Link</a>

                                </li>

                                <li class="inline-block ltr:mr-3 rtl:ml-3">

                                    <a class="hover:text-brand-500" href="#">Link</a>

                                </li>

                            </ul>

                        </div>

                        <div
                            class="w-full max-w-full flex-shrink px-4 text-center md:w-1/2 md:ltr:text-right md:rtl:text-left">

                            <p class="mb-0 mt-3 md:mt-0">

                                <a class="hover:text-brand-500" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
                                | All right reserved

                            </p>

                        </div>

                    </div>

                </div>

            </footer>

        </div>

    </div>

    @include('partials.message-bag')

    @livewireScripts

    @stack('javascript')

    <script>
        $('#mass-delete').click(function(e) {
            $('#id_set').val($.map($(':checkbox[name=select-me\\[\\]]:checked'), function(n, i) {
                return n.value;
            }).join(','));

            return true;
        });
        Livewire.on('close-upload-resource-modal', () => {
            if (document.querySelector('#upload-modal')) {
                document.querySelector('#upload-modal').classList.add('hidden');
            }
            if (document.querySelector('#upload-resource')) {
                document.querySelector('#upload-resource').classList.add('hidden');
            }
        });

        Livewire.on('close-new-conversation-modal', () => {
            if (document.querySelector('#new-conversation')) {
                document.querySelector('#new-conversation').classList.add('hidden');
            }
        });
    </script>

</body>

</html>
