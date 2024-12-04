@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Articles</a>

    </div>
@endsection

@section('title')
    Strategy Tools &amp; Resources
@endsection

@section('content')


    <form method="GET">

        <div class="search-form px-5">

            <input class="search-box" name="search" placeholder="Search articles" value="{{ request()->input('search') }}" />

            <button class="search-button" type="submit">GO</button>

        </div>

        <div class="my-4 mx-5 flex items-center justify-between">

            <select class="hidden" id="format-selector" name="format" onchange="this.form.submit();">

                <option @if ('all' == request()->input('format')) selected @endif value="all">All Formats</option>

                @foreach ($formats as $format)
                    <option @if ($format == request()->input('format')) selected @endif value="{{ strtolower($format) }}">
                        {{ $format }}</option>
                @endforeach

            </select>

            <div class="flex items-center gap-5">

                <div @click.away="isOpen = false" class="relative mt-1" x-data="{ isOpen: false }">

                    <button @click="isOpen = !isOpen" aria-expanded="true" aria-haspopup="listbox"
                        aria-labelledby="listbox-label"
                        class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                        type="button">

                        <span class="block truncate"
                            id="format-selector-display">{{ $current_format ? $current_format : 'All Formats' }}</span>

                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">

                            <svg aria-hidden="true" class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">

                                <path clip-rule="evenodd"
                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    fill-rule="evenodd" />

                            </svg>

                        </span>

                    </button>

                    <ul aria-labelledby="user-menu-button" aria-orientation="vertical"
                        class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" style="z-index: 999;" tabindex="-1" x-show="isOpen"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:leave-end="opacity-0 scale-95" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform">

                        <li class="relative cursor-default select-none py-2 text-gray-900" id="listbox-option-0"
                            role="option">

                            <span class="block truncate py-1 px-4 font-normal hover:bg-slate-200"
                                onclick="document.querySelector('#format-selector-display').innerHTML = 'All Formats'; document.querySelector('#format-selector').value = 'all'; document.querySelector('#format-selector').onchange();">
                                All Formats </span>

                            @foreach ($formats as $format)
                                <span class="block truncate py-1 px-4 font-normal hover:bg-slate-200"
                                    onclick="document.querySelector('#format-selector-display').innerHTML = '{{ $format }}'; document.querySelector('#format-selector').value = '{{ strtolower($format) }}'; document.querySelector('#format-selector').onchange();">
                                    {{ $format }} </span>
                            @endforeach

                        </li>

                    </ul>

                </div>

            </div>

            <select class="hidden" id="topic-selector" name="topic" onchange="this.form.submit();">

                <option @if ('all' == request()->input('topic')) selected @endif value="all">All Topics</option>

                @foreach ($topics as $topic)
                    <option @if ($topic->slug == request()->input('topic')) selected @endif value="{{ $topic->slug }}">
                        {{ $topic->name }}</option>
                @endforeach

            </select>

            <div class="flex items-center gap-5">

                <div @click.away="isOpen = false" class="relative mt-1" x-data="{ isOpen: false }">

                    <button @click="isOpen = !isOpen" aria-expanded="true" aria-haspopup="listbox"
                        aria-labelledby="listbox-label"
                        class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                        type="button">

                        <span class="block truncate"
                            id="topic-selector-display">{{ $current_topic ? $current_topic->getName() : 'All Topics' }}</span>

                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">

                            <svg aria-hidden="true" class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">

                                <path clip-rule="evenodd"
                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    fill-rule="evenodd" />

                            </svg>

                        </span>

                    </button>

                    <ul aria-labelledby="user-menu-button" aria-orientation="vertical"
                        class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" style="z-index: 999;" tabindex="-1" x-show="isOpen"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:leave-end="opacity-0 scale-95" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform">

                        <li class="relative cursor-default select-none py-2 text-gray-900" id="listbox-option-0"
                            role="option">

                            <span class="block truncate py-1 px-4 font-normal hover:bg-slate-200"
                                onclick="document.querySelector('#topic-selector-display').innerHTML = 'All Topics'; document.querySelector('#topic-selector').value = 'all'; document.querySelector('#topic-selector').onchange();">
                                All Topics </span>

                            @foreach ($topics as $topic)
                                <span class="block truncate py-1 px-4 font-normal hover:bg-slate-200"
                                    onclick="document.querySelector('#topic-selector-display').innerHTML = '{{ $topic->getName() }}'; document.querySelector('#topic-selector').value = '{{ $topic->slug }}'; document.querySelector('#topic-selector').onchange();">
                                    {{ $topic->getName() }} </span>
                            @endforeach

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </form>

    <hr />

    @if (request()->has('search') && request()->input('search'))
        <div class="my-8 text-center text-lg font-bold">Search Results for "{{ request()->input('search') }}"
        </div>
    @else
        <div class="my-8 text-center text-lg font-bold">Strategy Tools

            @if ($current_topic)
                : {{ $current_topic->getName() }}
            @endif

        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4">

        @foreach ($articles as $article)
            @include('dashboard.strategy-tools.partials.card', ['article' => $article])
        @endforeach

    </div>

    <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

        {{ $articles->appends($_GET)->links() }}

    </div>


@endsection
