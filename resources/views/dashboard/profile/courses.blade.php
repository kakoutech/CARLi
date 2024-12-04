@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-courses') }}">My Courses</a>

    </div>
@endsection

@section('title')
    My Courses
@endsection

@section('content')

    <div class="rounded-lg bg-white shadow">

        <div class="flow-root">

            <div class="bg-brand-500 flex items-center rounded-t-lg text-white">

                <div class="w-full py-2 text-center">

                    <span class="block text-sm font-bold uppercase">Courses</span>

                </div>

            </div>

            @if ($courses && $courses->count())
                <div class="p-10">

                    <ul class="grid gap-10 md:grid-cols-4" role="list">

                        @foreach ($courses as $course)
                            @if ($course->course)
                                <li class="relative text-center">

                                    <a href="{{ route('dashboard.my-courses.view', [$course->id]) }}">

                                        <div
                                            class="aspect-w-10 aspect-h-8 group block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">

                                            <img alt=""
                                                class="pointer-events-none h-full w-full object-cover group-hover:opacity-75"
                                                src="{{ $course->course->getImage() }}">

                                        </div>

                                        <p
                                            class="pointer-events-none mt-2 block truncate text-lg font-medium leading-none text-gray-900">
                                            {{ $course->course->getTitle() }}</p>
                                        <p
                                            class="text-brand-500 pointer-events-none block truncate text-lg font-medium leading-none">
                                            {{ $course->course->trainer ? $course->course->trainer->getFullName() : '' }}
                                        </p>
                                        <p
                                            class="pointer-events-none mt-2 block truncate text-sm font-medium leading-none text-gray-700">
                                            {{ $course->course->topic ? $course->course->topic->getName() : '' }}</p>
                                        <p
                                            class="mt-1leading-none pointer-events-none block truncate text-sm font-medium text-gray-500">
                                            Duration: {{ $course->course->getDuration() }} Minutes</p>


                                    </a>

                                </li>
                            @endif
                        @endforeach

                    </ul>

                </div>
            @else
                <div class="m-5">

                    <div class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                        <svg 0 class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5"
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
