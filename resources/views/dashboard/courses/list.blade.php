@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses') }}">Tools &amp; Resources</a>

    </div>
@endsection

@section('title')
    Tools &amp; Resources
@endsection

@section('content')

    <div class="items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3 md:flex">

        <div class="flex flex-col justify-center pl-3 text-white">
            <div class="mb-5 text-xl font-bold leading-none md:mb-0">Courses</div>
            @if (request()->has('search') && request()->input('search'))
                <div class="text-sm">Search results for: {{ request()->input('search') }}</div>
            @endif
        </div>

        <div>

            <div class="gap-3 md:flex">

                <a class="mb-3 flex items-center rounded-md bg-white py-2 px-5 leading-5 text-gray-800 md:mb-0"
                    href="{{ route('dashboard.courses.add') }}">
                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    New Course
                </a>

                <form action="{{ route('dashboard.courses.mass-delete') }}" method="POST">
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
                        name="search" placeholder="Search Courses" type="search" value="{{ request()->input('search') }}">
                </form>

            </div>

        </div>

    </div>

    <div class="rounded-lg bg-white shadow">

        <div class="flow-root">

            <div class="hidden items-center bg-gray-200 md:flex">

                <div class="w-20 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Thumb</span>
                </div>

                <div class="w-2/12 flex-grow px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Title</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Duration</span>
                </div>

                <div class="w-2/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Topic</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">View Scope</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Enrolled</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Resources</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-sm font-bold uppercase">Status</span>
                </div>

                <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
                    <span class="block text-right text-sm font-bold uppercase">Actions</span>
                </div>

            </div>

            @if ($courses && $courses->count())
                <div class="divide-y divide-gray-200">

                    @foreach ($courses as $course)
                        <div class="py-4">

                            <div class="items-center md:flex">

                                <div class="w-12 flex-shrink-0 flex-grow-0 px-4">
                                    <input class="select-me" name="select-me[]" type="checkbox" value="{{ $course->id }}">
                                </div>

                                <div class="r-2 flex-shrink-0 flex-grow-0 pl-4 text-center md:w-24">

                                    <img class="h-24 w-24 bg-gray-100 object-contain" src="{{ $course->getThumbnail() }}" />

                                </div>

                                <div class="flex-grow px-4 md:w-3/12">

                                    <div>

                                        <a class="truncate text-lg font-bold text-gray-900"
                                            href="{{ route('dashboard.courses.view', [$course->id]) }}">{{ $course->getTitle() }}</a>

                                    </div>

                                    <div>

                                        @if ($course->trainer)
                                            Trainer: <a class="font-bold text-brand-500"
                                                href="{{ route('dashboard.trainers.view', [$course->trainer_id]) }}">{{ $course->trainer->getFullName() }}</a>
                                        @endif

                                    </div>

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                    <div class="text-sm">

                                        @if ($course->getDuration())
                                            {{ $course->getDuration() }} Minutes
                                        @else
                                            -
                                        @endif

                                    </div>


                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

                                    @if ($course->topic)
                                        {{ $course->topic->getName() }}
                                    @else
                                        -
                                    @endif

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                    {{ $course->getViewScope() }}

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                    {{ $course->getEnrollCount() }}

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                    {{ $course->getResourceCount() }}

                                </div>

                                <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                                    @if ($course->isActive())
                                        <p class="truncate text-sm font-medium text-green-500">Active</p>
                                    @else
                                        <p class="truncate text-sm font-medium text-red-500">Draft</p>
                                    @endif

                                </div>

                                <div class="flex flex-shrink-0 flex-grow-0 justify-end px-4 md:w-1/12">

                                    <a class="cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                        href="{{ route('dashboard.courses.edit', [$course->id]) }}"> Edit </a>

                                    <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                        href="#"
                                        onclick="if(confirm('Are you sure you want to delete this course?')) document.getElementById('delete_course_{{ $course->id }}').submit()">
                                        Delete </a>

                                    <form action="{{ route('dashboard.courses.delete', [$course->id]) }}" class="inline"
                                        id="delete_course_{{ $course->id }}" method="POST">

                                        @csrf

                                        @method('delete')

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

                        <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No courses found matching your
                            criteria. </span>

                    </div>

                </div>
            @endif

        </div>

    </div>

    @if ($courses->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $courses->links() }}

        </div>
    @endif

@endsection
