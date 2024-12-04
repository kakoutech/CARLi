@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification') }}">Gamification</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification.settings') }}">Badges</a>

    </div>
@endsection

@section('title')
    Gamification Badges
@endsection

@section('content')
    <div x-data="{ tab: '{{ $badges->first()->slug }}' }">

        <div class="items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3 md:flex">

            <div class="flex flex-col justify-center pl-3 text-white">
                <div class="mb-5 text-xl font-bold leading-none md:mb-0">
                    @foreach ($badges as $badge)
                        <div x-show="tab === '{{ $badge->slug }}'">{{ $badge->getName() }} Badges</div>
                    @endforeach
                </div>
                @if (request()->has('search') && request()->input('search'))
                    <div class="text-sm">Search results for: {{ request()->input('search') }}</div>
                @endif
            </div>

            <div>

                <div class="gap-3 md:flex">

                    @foreach ($badges as $badge)
                        <a class="mb-3 flex items-center rounded-md bg-white py-2 px-5 leading-5 text-gray-800 md:mb-0"
                            href="{{ route('dashboard.gamification.badges.add', [$badge->id]) }}"
                            x-show="tab === '{{ $badge->slug }}'">
                            <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            New {{ $badge->getName() }} Badge Level
                        </a>
                    @endforeach

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
                            name="search" placeholder="Search Badges" type="search"
                            value="{{ request()->input('search') }}">
                    </form>

                </div>

            </div>

        </div>

        <div class="rounded-b-lg bg-white shadow">

            <div class="block">
                <nav aria-label="Tabs" class="md:flex md:space-x-4">
                    @foreach ($badges as $badge)
                        <a @click.prevent="tab = '{{ $badge->slug }}'"
                            :class="{
                                'border-indigo-500 text-indigo-600': tab == '{{ $badge->slug }}',
                                'border-white': tab !=
                                    '{{ $badge->slug }}'
                            }"
                            class="flex cursor-pointer whitespace-nowrap border-b-2 py-4 px-4 text-sm font-medium">
                            {{ $badge->getName() }} Badges </a>
                    @endforeach
                </nav>
            </div>

            <div class="flow-root">

                <div class="hidden items-center bg-gray-200 md:flex">

                    <div class="w-6/12 flex-grow px-4 py-2">
                        <span class="block text-sm font-bold uppercase">Name</span>
                    </div>

                    <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                        <span class="block text-sm font-bold uppercase">Points</span>
                    </div>

                    <div class="w-2/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                        <span class="block text-sm font-bold uppercase">Image</span>
                    </div>

                    <div class="w-2/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                        <span class="block text-sm font-bold uppercase">Status</span>
                    </div>

                    <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                        <span class="block text-right text-sm font-bold uppercase">Actions</span>
                    </div>

                </div>

                @foreach ($badges as $badge)
                    <div class="divide-y divide-gray-200" x-show="tab == '{{ $badge->slug }}'">

                        @if ($badge->levels && $badge->levels->count())
                            @foreach ($badge->levels as $level)
                                <div class="py-4">

                                    <div class="items-center md:flex">

                                        <div class="flex-grow px-4 md:w-6/12">

                                            <div class="truncate text-lg font-bold text-gray-900">

                                                <a
                                                    href="{{ route('dashboard.gamification.badges.levels', [$badge->id, $level->id]) }}">{{ $level->getName() }}</a>

                                            </div>

                                            <div class="text-xs font-bold uppercase text-gray-500">{{ $badge->getName() }}
                                            </div>

                                        </div>

                                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                            <div class="font-bold">{{ $level->getCondition() }}</div>

                                        </div>

                                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

                                            <div><img class="h-24 w-24" src="{{ $level->getImage() }}" /></div>

                                        </div>

                                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

                                            @if ($level->isActive())
                                                <p class="truncate text-sm font-medium text-green-500">Active</p>
                                            @else
                                                <p class="truncate text-sm font-medium text-red-500">Draft</p>
                                            @endif

                                        </div>

                                        <div class="flex flex-shrink-0 flex-grow-0 justify-end px-4 md:w-1/12">

                                            <a class="cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                                href="{{ route('dashboard.gamification.badges.levels', [$badge->id, $level->id]) }}">
                                                View </a>
                                            <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                                href="{{ route('dashboard.gamification.badges.levels.edit', [$badge->id, $level->id]) }}">
                                                Edit </a>

                                            <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                                href="#"
                                                onclick="if(confirm('Are you sure you want to delete this level?')) document.getElementById('delete_level_{{ $level->id }}').submit()">
                                                Delete </a>

                                            <form
                                                action="{{ route('dashboard.gamification.badges.levels.delete', [$badge->id, $level->id]) }}"
                                                class="inline" id="delete_level_{{ $level->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>

                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="m-5">

                                <div
                                    class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                                    <svg 0 class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No levels found
                                        matching your criteria. </span>

                                </div>

                            </div>
                        @endif

                    </div>
                @endforeach

            </div>

        </div>

    </div>
@endsection
