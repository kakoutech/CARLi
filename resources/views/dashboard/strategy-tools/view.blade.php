@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles.view', [$article->id]) }}">View Article</a>

    </div>
@endsection

@section('title')
    Article Overview - {{ $article->getTitle() }}
@endsection

@section('content')
    <div class="rounded-lg bg-white shadow">

        <div class="" x-data="{ tab: '{{ request()->input('tab') == 'resources' ? 'resources' : 'overview' }}' }">

            <div class="border-b border-gray-200">

                <nav aria-label="Tabs" class="-mb-px flex space-x-8">

                    <a @click="tab = 'overview'"
                        :class="{ 'border-indigo-500 text-indigo-600': tab ==
                            'overview', 'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                'overview' }"
                        class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                        Overview

                    </a>

                    <a @click="tab = 'resources'"
                        :class="{ 'border-indigo-500 text-indigo-600': tab ==
                            'resources', 'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                'resources' }"
                        class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                        Resources

                        <span
                            :class="{ 'bg-gray-100 text-gray-900': tab != 'resources', 'bg-indigo-100 text-indigo-600': tab ==
                                    'resources' }"
                            class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{ $article->getResourceCount() }}</span>

                    </a>

                </nav>

            </div>

            <div>

                <div x-show="tab == 'overview'">

                    @include('dashboard.strategy-tools.partials.preview')

                </div>

                <div x-show="tab == 'resources'">

                    @include('dashboard.strategy-tools.partials.resource-table')

                    <div class="py-5 px-2">

                        <a class="toggle-upload-resource-modal ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            data-article="{{ $article->id }}" href="#">
                            <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Upload Resource
                        </a>

                        <a class="toggle-assign-resource-modal ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            data-article="{{ $article->id }}" href="#">
                            <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Assign Resource
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="assign-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Assign Resource

            </div>

            <div class="p-5">

                @livewire('strategy-tools.assign-resource', [route('dashboard.strategy-tools.articles.view', [$article->id, 'tab' => 'resources']), $article])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="upload-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Upload Resource

            </div>

            <div class="p-5">

                @livewire('strategy-tools.upload-resource', ['article' => $article])

            </div>

        </div>

    </div>

    <script>
        var btns = document.querySelectorAll('.toggle-assign-resource-modal');

        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector('#assign-resource').classList.toggle('hidden');
            });
        }

        var btns = document.querySelectorAll('.toggle-upload-resource-modal');

        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector('#upload-resource').classList.toggle('hidden');
            });
        }
    </script>
@endsection
