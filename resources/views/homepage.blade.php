@extends('layouts.app')

@section('head')
    Home
@endsection

@section('content')
    <div class="mt-10">

        <div class="container">

            <div class="text-center">

                <h1 class="mb-6 text-center text-2xl font-bold text-brand-500">Welcome, {{ auth()->user()->getFullName() }}
                </h1>

            </div>

            <div class="px-5 pb-10">
                <div
                    class="relative flex flex-col items-center justify-center overflow-hidden rounded-lg bg-gray-50 p-10 shadow-2xl">

                    <div class="text-center text-xl font-bold">Messages &amp; Notifications</div>

                    <ul class="divide-y divide-gray-200" role="list">
                        <li class="relative py-5 px-4 hover:bg-white">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a class="block focus:outline-none" href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        <p class="truncate text-sm font-medium text-gray-900">Gloria Roberston</p>
                                    </a>
                                </div>
                                <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500"
                                    datetime="2021-01-27T16:35">1d ago</time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-sm text-gray-600">Doloremque dolorem maiores assumenda dolorem
                                    facilis.
                                    Velit vel in a rerum natus facer.</p>
                            </div>
                        </li>
                        <li class="relative py-5 px-4 hover:bg-white">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a class="block focus:outline-none" href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        <p class="truncate text-sm font-medium text-gray-900">Gloria Roberston</p>
                                    </a>
                                </div>
                                <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500"
                                    datetime="2021-01-27T16:35">1d ago</time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-sm text-gray-600">Doloremque dolorem maiores assumenda dolorem
                                    facilis.
                                    Velit vel in a rerum natus facer.</p>
                            </div>
                        </li>
                        <li class="relative py-5 px-4 hover:bg-white">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a class="block focus:outline-none" href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        <p class="truncate text-sm font-medium text-gray-900">Gloria Roberston</p>
                                    </a>
                                </div>
                                <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500"
                                    datetime="2021-01-27T16:35">1d ago</time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-sm text-gray-600">Doloremque dolorem maiores assumenda dolorem
                                    facilis.
                                    Velit vel in a rerum natus facer.</p>
                            </div>
                        </li>
                        <li class="relative py-5 px-4 hover:bg-white">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a class="block focus:outline-none" href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        <p class="truncate text-sm font-medium text-gray-900">Gloria Roberston</p>
                                    </a>
                                </div>
                                <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500"
                                    datetime="2021-01-27T16:35">1d ago</time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-sm text-gray-600">Doloremque dolorem maiores assumenda dolorem
                                    facilis.
                                    Velit vel in a rerum natus facer.</p>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="grid grid-cols-2">


                <a class="bg-white" href="{{ route('reflective-journal') }}">

                    <div class="px-5 pb-10">

                        <div
                            class="relative flex flex-col items-center justify-center overflow-hidden rounded-lg bg-gray-50 p-10 shadow-2xl">

                            <div class="h-24 w-24 bg-cover"
                                style="background-image: url('{{ asset('assets/img/reflective-journal.png') }}');"></div>

                            <div class="mt-6">

                                <div class="text-center text-xl font-bold">Reflective Journal</div>

                                <p class="text-center text-base text-gray-700">Quas Non Vel Tenetur Libero Eveniet</p>

                            </div>

                        </div>

                    </div>

                </a>

                <a class="bg-white" href="{{ route('strategy-tools') }}">

                    <div class="px-5 pb-10">

                        <div
                            class="relative flex flex-col items-center justify-center overflow-hidden rounded-lg bg-gray-50 p-10 shadow-2xl">

                            <div class="h-24 w-24 bg-cover"
                                style="background-image: url('{{ asset('assets/img/strategies-tools.png') }}');"></div>

                            <div class="mt-6">

                                <div class="text-center text-xl font-bold">Strategy Tools</div>

                                <p class="text-center text-base text-gray-700">Quas Non Vel Tenetur Libero Eveniet</p>

                            </div>

                        </div>

                    </div>

                </a>

                <a class="bg-white" href="{{ route('tools-and-resources') }}">

                    <div class="px-5 pb-10">

                        <div
                            class="relative flex flex-col items-center justify-center overflow-hidden rounded-lg bg-gray-50 p-10 shadow-2xl">

                            <div class="h-24 w-24 bg-cover"
                                style="background-image: url('{{ asset('assets/img/tools-and-resources.png') }}');"></div>

                            <div class="mt-6">

                                <div class="text-center text-xl font-bold">Tools &amp; Resources</div>

                                <p class="text-center text-base text-gray-700">Quas Non Vel Tenetur Libero Eveniet</p>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>
@endsection
