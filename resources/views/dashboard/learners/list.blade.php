@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners') }}">Learners</a>

    </div>
@endsection

@section('title')
    Student List
@endsection

@section('content')
    <div class="items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3 md:flex">

        <div class="flex flex-col justify-center pl-3 text-white">
            <div class="mb-5 text-xl font-bold leading-none md:mb-0">Learners</div>
            @if (request()->has('search') && request()->input('search'))
                <div class="text-sm">Search results for: {{ request()->input('search') }}</div>
            @endif
        </div>

        <div>

            <div class="gap-3 md:flex">

                <a class="mb-3 flex items-center rounded-md bg-white py-2 px-5 leading-5 text-gray-800 md:mb-0"
                    href="{{ route('dashboard.learners.add') }}">
                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    New Learner
                </a>

                <form action="{{ route('dashboard.learners.mass-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="id_set" name="ids" type="hidden">
                    <button class="mb-3 flex items-center rounded-md bg-white py-2 px-5 leading-5 text-gray-800 md:mb-0"
                        id="mass-delete" type="submit">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Delete</button>
                </form>

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
                        name="search" placeholder="Search Learners" type="search"
                        value="{{ request()->input('search') }}">
                </form>

            </div>

        </div>

    </div>

    <div class="rounded-b-lg bg-white shadow">

        @include('dashboard.learners.partials.table')

    </div>

    @if ($users->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $users->links() }}

        </div>
    @endif
@endsection
