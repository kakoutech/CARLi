@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.super-admins') }}">Super Admin</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.super-admins.deleted') }}">Deleted</a>

    </div>
@endsection

@section('title')
    Deleted Super Admins
@endsection

@section('content')

    <div class="items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3 md:flex">

        <div class="flex flex-col justify-center pl-3 text-white">
            <div class="mb-5 text-xl font-bold leading-none md:mb-0">Super Admin</div>
            @if (request()->has('search') && request()->input('search'))
                <div class="text-sm">Search results for: {{ request()->input('search') }}</div>
            @endif
        </div>

        <div>

            <div class="gap-3 md:flex">

                <a class="mb-3 flex items-center rounded-md bg-white py-2 px-5 leading-5 text-gray-800 md:mb-0"
                    href="{{ route('dashboard.super-admins.add') }}">
                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    New Super Admin
                </a>

                <form class="relative text-white focus-within:text-gray-600" method="GET">
                    <div class="pointer-events-none absolute inset-y-0 left-0 top-0 flex h-10 items-center pl-3">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input
                        class="block w-full rounded-md border border-transparent bg-white bg-opacity-20 py-2 pl-10 pr-3 leading-5 text-white placeholder-white focus:border-transparent focus:bg-opacity-100 focus:text-gray-900 focus:placeholder-gray-500 focus:outline-none focus:ring-0 sm:text-sm"
                        name="search" placeholder="Search Super Admins" type="search"
                        value="{{ request()->input('search') }}">
                </form>

            </div>

        </div>

    </div>

    <div class="rounded-b-lg bg-white shadow">

        <div class="flow-root">

            <div class="hidden items-center bg-gray-200 md:flex">

                <div class="w-4/12 flex-grow px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Name</span>
                </div>

                <div class="w-4/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Email</span>
                </div>

                <div class="w-2/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Telephone</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Status</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-right text-sm font-bold uppercase">Actions</span>
                </div>

            </div>

            @if ($users && $users->count())
                <div class="divide-y divide-gray-200">

                    @foreach ($users as $user)
                        <div class="py-4">

                            <div class="flex items-center">

                                <div class="flex-grow px-4 md:w-4/12">

                                    <div class="flex items-center justify-start gap-5">

                                        <div class="w-16"><img alt="" class="mx-auto h-12 w-12 rounded-full"
                                                src="{{ $user->getAvatar() }}"></div>

                                        <div><a
                                                href="{{ route('dashboard.super-admins.view', [$user->id]) }}"class="text-lg font-bold text-gray-900 truncate">{{ $user->getFullName() }}</a>
                                        </div>

                                    </div>

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-4/12">

                                    <p class="truncate text-sm text-gray-500">{{ $user->email }}</p>

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

                                    <p class="truncate text-sm text-gray-500">
                                        {{ $user->telephone_number }}
                                    </p>

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                    @if ($user->active)
                                        <p class="truncate text-sm font-bold text-green-500">Active</p>
                                    @else
                                        <p class="truncate text-sm font-bold text-red-500">Inactive</p>
                                    @endif

                                </div>

                                <div class="flex flex-shrink-0 flex-grow-0 justify-end px-4 md:w-1/12">

                                    <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                        onclick="if(confirm('Are you sure you want to restore this super admin?')) document.getElementById('restore_user_{{ $user->id }}').submit()">
                                        Restore </a>

                                    <form action="{{ route('dashboard.super-admins.restore', [$user->id]) }}"
                                        class="inline" id="restore_user_{{ $user->id }}" method="POST">
                                        @csrf
                                    </form>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="m-5">

                    <div class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                        <svg class="mx-auto h-12 w-12 text-gray-400"0 fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No super-admins found matching
                            your criteria. </span>

                    </div>

                </div>
            @endif

        </div>

    </div>

    @if ($users->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $users->links() }}

        </div>
    @endif

@endsection
