@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.resources') }}">Resources</a>

    </div>
@endsection

@section('title')
    Resources
@endsection

@section('content')

    <div class="flex items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3">

        <div class="flex flex-col justify-center pl-3 text-white">
            <div class="mb-5 text-xl font-bold leading-none md:mb-0">Resources</div>
            @if (request()->has('search') && request()->input('search'))
                <div class="text-sm">Search results for: {{ request()->input('search') }}</div>
            @endif
        </div>

        <div>

            <div class="gap-3 md:flex">

                <a class="toggle-upload-modal mb-3 flex items-center rounded-md bg-white py-2 px-5 leading-5 text-gray-800 md:mb-0"
                    href="{{ route('dashboard.strategy-tools.resources.add') }}">
                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Upload Resource
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
                        name="search" placeholder="Search Resources" type="search"
                        value="{{ request()->input('search') }}">
                </form>

            </div>

        </div>

    </div>

    <div class="rounded-lg bg-white shadow">

        <div class="flow-root">

            <div class="flex items-center bg-gray-200">
                <div class="w-full py-2 text-center">
                    <span class="block text-sm font-bold uppercase">Resources</span>
                </div>

            </div>

            @if ($resources && $resources->count())
                <div class="p-5">

                    <ul class="grid grid-cols-4 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-6 xl:gap-x-8"
                        role="list">

                        @foreach ($resources as $resource)
                            @include('dashboard.course-resources.partials.card')
                        @endforeach

                    </ul>

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

                        <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No resources found matching
                            your criteria. </span>

                    </div>

                </div>
            @endif

        </div>

    </div>

    @if ($resources->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $resources->links() }}

        </div>
    @endif

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="upload-modal" style="z-index:99;">

        <div class="max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Upload Resource</div>

                <div class="toggle-upload-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('strategy-tools.upload-resource', ['article' => null])

            </div>

        </div>

    </div>

    <script>
        var btns = document.querySelectorAll('.toggle-upload-modal');

        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector('#upload-modal').classList.toggle('hidden');
            });
        }
    </script>

@endsection
