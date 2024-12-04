@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification') }}">Gamification</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification.history') }}">History</a>

    </div>
@endsection

@section('title')
    Gamification History
@endsection

@section('content')
    <div class="rounded-b-lg bg-white shadow">

        <div class="flex items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3">

            <div class="flex flex-col justify-center pl-3 text-white">
                <div class="mb-5 text-xl font-bold leading-none md:mb-0">Points</div>
                @if (request()->has('search') && request()->input('search'))
                    <div class="text-sm">Search results for: {{ request()->input('search') }}</div>
                @endif
            </div>

            <div>

                <div class="gap-3 md:flex">

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
                            name="search" placeholder="Search Points" type="search"
                            value="{{ request()->input('search') }}">
                    </form>

                </div>

            </div>

        </div>

        @include('dashboard.gamification.partials.points-table')

    </div>

    @if ($points->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $points->links() }}

        </div>
    @endif
@endsection
