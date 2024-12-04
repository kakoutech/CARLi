@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-courses') }}">My Courses</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-courses.view', [$course->id]) }}">View Course</a>

    </div>
@endsection

@section('title')
    {{ $course->course->getTitle() }}
@endsection

@section('content')
    <div class="gap-5 md:flex">

        <div class="mb-6 flex-shrink-0 flex-grow-0 md:mb-0 md:w-1/4">

            <div class="mb-6 w-full rounded-lg bg-white shadow">

                @include('dashboard.profile.partials.course-card', ['course' => $course->course])

            </div>

            <div class="w-full rounded-lg bg-white shadow">

                <div class="mb-5 mt-10 border-b p-5">

                    <div class="truncate text-lg font-bold text-gray-900">Assigned MCQs</div>

                </div>

                <div class="px-5 pb-5">
                    @foreach (auth()->user()->assignedQuestionSets()->where('course_id', '=', $course->course_id)->get() as $mcq)
                        <div class="border-b pb-3">
                            <div class="truncate font-bold text-gray-600">{{ $mcq->mcq->getName() }}</div>
                            <div class="flex justify-between">
                                <div class="text-sm">{{ $mcq->combinedDateTime()->format('d/m/Y H:iA') }}</div>
                                <div class="text-right">

                                    @if ($mcq->isFuture())
                                        <span
                                            class="cursor-not-allowed items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 opacity-50 shadow-sm hover:bg-gray-50"
                                            href="{{ route('dashboard.my-competency-tests.view', [$mcq->id]) }}">
                                            Take Test Now</span>
                                    @else
                                        <a class="cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                            href="{{ route('dashboard.my-competency-tests.view', [$mcq->id]) }}">
                                            Take Test Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

        <div class="flex-grow md:w-3/4">

            <div class="rounded-lg bg-white shadow">

                <div class="relative overflow-hidden rounded bg-white shadow">

                    <img alt="{{ $course->course->getTitle() }}" class="w-full" src="{{ $course->course->getImage() }}">


                    <div class="px-6 py-4 text-center">

                        <div class="mb-2 text-xl font-bold">{{ $course->course->getTitle() }}</div>

                    </div>

                    <hr />

                    <div class="px-6 py-4">

                        {!! $course->course->getContent() !!}

                    </div>

                </div>

            </div>

            <div class="mt-6" x-data="{ tab: 'read' }">
                <div>
                    <div class="hidden sm:block">
                        <nav aria-label="Tabs" class="relative z-0 flex divide-x divide-gray-200 rounded-lg shadow">
                            <a @click="tab = 'read'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'read',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'read'
                                }"
                                class="group relative min-w-0 flex-1 overflow-hidden rounded-l-lg bg-white py-4 px-4 text-center text-sm font-medium text-gray-900 hover:bg-gray-50 focus:z-10">
                                <span>Read</span>
                                <span
                                    :class="{
                                        'bg-indigo-500': tab ==
                                            'read',
                                        'bg-transparent': tab !=
                                            'read'
                                    }"
                                    aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5"></span>
                            </a>

                            <a @click="tab = 'watch'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'watch',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'watch'
                                }"
                                class="group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
                                <span>Watch</span>
                                <span
                                    :class="{
                                        'bg-indigo-500': tab ==
                                            'watch',
                                        'bg-transparent': tab !=
                                            'watch'
                                    }"
                                    aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5"></span>
                            </a>

                            <a @click="tab = 'listen'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'listen',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'listen'
                                }"
                                class="group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
                                <span>Listen</span>
                                <span
                                    :class="{
                                        'bg-indigo-500': tab ==
                                            'listen',
                                        'bg-transparent': tab !=
                                            'listen'
                                    }"
                                    aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5"></span>
                            </a>
                        </nav>
                    </div>
                </div>


                @foreach (['read', 'watch', 'listen'] as $type)
                    <div class="rounded-lg bg-white px-5 shadow" x-show="tab == '{{ $type }}'">

                        @php
                            $resources = $course->course
                                ->resources()
                                ->where('type', '=', $type)
                                ->get();
                        @endphp

                        @if ($resources && $resources->count())
                            <div class="owl-carousel">

                                @foreach ($resources as $_resource)
                                    @php $resource = $_resource->resource; @endphp

                                    <div class="m-5">
                                        <div class="h-48 w-full">
                                            @if ($resource->isEmbed())
                                                {!! $resource->getEmbed() !!}
                                            @elseif ($resource->isVideo())
                                                <video class="w-full" controls>

                                                    <source src="{{ $resource->getFile() }}" type="video/mp4">

                                                    Your browser does not support the video element.

                                                </video>
                                            @elseif ($resource->isPdf())
                                                <a class="text-center" href="{{ $resource->getFile() }}" target="_blank">

                                                    <div
                                                        class="inline-block rounded-md border border-gray-300 bg-white py-2 px-4 text-xl font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                        View PDF</div>

                                                </a>
                                            @elseif ($resource->isAudio())
                                                <div class="my-5 rounded-full bg-slate-200 p-2">

                                                    <audio class="w-full" controls>

                                                        <source src="{{ $resource->getFile() }}">

                                                        Your browser does not support the audio element.

                                                    </audio>

                                                </div>
                                            @elseif ($resource->isImage())
                                                <a href="{{ $resource->getFile() }}" target="_blank">

                                                    <img class="h-full w-full object-cover"
                                                        src="{{ $resource->getFile() }}" />

                                                </a>
                                            @endif
                                        </div>
                                        <div class="mt-2 mb-2 px-5 text-lg font-bold">{{ $resource->getFilename() }}</div>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div class="py-5">

                                <div
                                    class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                                    <svg class="mx-auto h-12 w-12 text-gray-400"0 fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No resources.
                                    </span>

                                </div>

                            </div>
                        @endif

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    <script>
        $('.owl-carousel').owlCarousel({
            items: 3,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        });
    </script>
@endsection
