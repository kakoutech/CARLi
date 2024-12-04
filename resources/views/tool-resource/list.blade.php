@extends('layouts.app')

@section('head')

Tools &amp; Resources

@endsection

@section('content')

<div class="mt-10">

    <div class="container">

        <form method="GET">

            <div class="search-form px-5">

                <input class="search-box" name="search" value="{{ request()->input('search') }}" placeholder="Search articles" />

                <button type="submit" class="search-button">GO</button>

            </div>

            <div class="flex items-center justify-between my-4 mx-5">

                @if (auth()->user()->isTrainer())
    
                    <div>

                        <a href="{{ route('tools-and-resources.add') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Content</a>

                    </div>
        
                @endif

                <select id="format-selector" name="format" class="hidden" onchange="this.form.submit();">
                
                    <option value="all" @if ('all'==request()->input('format')) selected @endif>All Formats</option>
                
                    @foreach ($formats as $format)
                    <option @if ($format==request()->input('format')) selected @endif value="{{ strtolower($format) }}">{{ $format }}</option>
                
                    @endforeach
                
                </select>
                
                <div class="flex items-center gap-5">
                
                    <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="mt-1 relative">
                
                        <button @click="isOpen = !isOpen" type="button" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                
                            <span id="format-selector-display" class="block truncate">{{ $current_format ? $current_format : 'All Formats' }}</span>
                
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                
                                </svg>
                
                            </span>
                
                        </button>
                
                        <ul x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="z-index: 999;" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                
                            <li class="text-gray-900 cursor-default select-none relative py-2" id="listbox-option-0" role="option">
                
                                <span onclick="document.querySelector('#format-selector-display').innerHTML = 'All Formats'; document.querySelector('#format-selector').value = 'all'; document.querySelector('#format-selector').onchange();" class="font-normal block truncate hover:bg-slate-200 py-1 px-4"> All Formats </span>
                
                                @foreach ($formats as $format)
                
                                <span onclick="document.querySelector('#format-selector-display').innerHTML = '{{ $format }}'; document.querySelector('#format-selector').value = '{{ strtolower($format) }}'; document.querySelector('#format-selector').onchange();" class="font-normal block truncate hover:bg-slate-200 py-1 px-4"> {{ $format }} </span>
                
                                @endforeach
                
                            </li>
                
                        </ul>
                
                    </div>
                
                </div>

                <select id="topic-selector" name="topic" class="hidden" onchange="this.form.submit();">

                    <option value="all" @if ('all'==request()->input('topic')) selected @endif>All Topics</option>
                    
                    @foreach ($topics as $topic)

                        <option @if ($topic->slug == request()->input('topic')) selected @endif value="{{ $topic->slug }}">{{ $topic->name }}</option>

                    @endforeach

                </select>

                <div class="flex items-center gap-5">
                    
                    <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="mt-1 relative">

                        <button @click="isOpen = !isOpen" type="button" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                    
                            <span id="topic-selector-display" class="block truncate">{{ $current_topic ? $current_topic->getName() : 'All Topics' }}</span>
                            
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            
                                </svg>
                            
                            </span>

                        </button>

                        <ul x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="z-index: 999;" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        
                            <li class="text-gray-900 cursor-default select-none relative py-2" id="listbox-option-0" role="option">
                        
                                <span onclick="document.querySelector('#topic-selector-display').innerHTML = 'All Topics'; document.querySelector('#topic-selector').value = 'all'; document.querySelector('#topic-selector').onchange();" class="font-normal block truncate hover:bg-slate-200 py-1 px-4"> All Topics </span>

                                @foreach ($topics as $topic)
                        
                                <span onclick="document.querySelector('#topic-selector-display').innerHTML = '{{ $topic->getName() }}'; document.querySelector('#topic-selector').value = '{{ $topic->slug }}'; document.querySelector('#topic-selector').onchange();" class="font-normal block truncate hover:bg-slate-200 py-1 px-4"> {{ $topic->getName() }} </span>
                        
                                @endforeach
                        
                            </li>
                        
                        </ul>
    
                    </div>
    
                </div>

            </div>

        </form>

        <hr />

        @if (request()->has('search') && request()->input('search'))

            <div class="my-8 font-bold text-lg text-center">Search Results for "{{ request()->input('search') }}"</div>

        @else

            <div class="my-8 font-bold text-lg text-center">Tools &amp; Resources

                @if ($current_topic) : {{ $current_topic->getName() }} @endif
                
            </div>

        @endif

        <div class="grid md:grid-cols-2">

            @foreach ($articles as $article)

                @include('tool-resource.card')

            @endforeach

        </div>

        <div class="mt-8 bg-white mx-5">

            {{ $articles->appends($_GET)->links() }}

        </div>

    </div>

</div>

@endsection