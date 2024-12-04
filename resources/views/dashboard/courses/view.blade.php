@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses') }}">Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses.view', [$course->id]) }}">View Course</a>

    </div>
@endsection

@section('title')
    {{ $course->getTitle() }}
@endsection

@section('content')
    <div class="gap-5 md:flex">

        <div class="mb-6 flex-shrink-0 flex-grow-0 md:mb-0 md:w-1/4">

            <div class="w-full rounded-lg bg-white shadow">

                @include('dashboard.courses.partials.course-card')

            </div>

        </div>

        <div class="flex-grow md:w-3/4">

            <div class="rounded-lg bg-white shadow">

                <div class="" x-data="{ tab: '{{ request()->input('tab') ?: 'students' }}' }">

                    <div class="border-b border-gray-200">

                        <nav aria-label="Tabs" class="md:-mb-px md:flex md:space-x-8">

                            <a @click="tab = 'students'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'students',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'students'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Students

                                <span
                                    :class="{
                                        'bg-gray-100 text-gray-900': tab !=
                                            'students',
                                        'bg-indigo-100 text-indigo-600': tab == 'students'
                                    }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{ $course->getEnrollCount() }}</span>

                            </a>

                            <a @click="tab = 'read-resources'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'read-resources',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'read-resources'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">
                                'Read' Resources

                                <span
                                    :class="{
                                        'bg-gray-100 text-gray-900': tab !=
                                            'resources',
                                        'bg-indigo-100 text-indigo-600': tab == 'read-resources'
                                    }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{ $course->getResourceCount('read') }}</span>
                            </a>

                            <a @click="tab = 'watch-resources'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'watch-resources',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'watch-resources'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">
                                'Watch' Resources

                                <span
                                    :class="{
                                        'bg-gray-100 text-gray-900': tab !=
                                            'watch-resources',
                                        'bg-indigo-100 text-indigo-600': tab == 'watch-resources'
                                    }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{ $course->getResourceCount('watch') }}</span>
                            </a>

                            <a @click="tab = 'listen-resources'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'listen-resources',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'listen-resources'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">
                                'Listen' Resources

                                <span
                                    :class="{
                                        'bg-gray-100 text-gray-900': tab !=
                                            'listen-resources',
                                        'bg-indigo-100 text-indigo-600': tab == 'listen-resources'
                                    }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{ $course->getResourceCount('listen') }}</span>
                            </a>

                            <a @click="tab = 'mcqs'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'mcqs',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'mcqs'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">
                                MCQs

                                <span
                                    :class="{
                                        'bg-gray-100 text-gray-900': tab !=
                                            'mcqs',
                                        'bg-indigo-100 text-indigo-600': tab == 'mcqs'
                                    }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{ $course->getMultipleChoiceQuestionSetCount() }}</span>
                            </a>

                        </nav>

                    </div>

                    <div>

                        <div x-show="tab == 'students'">

                            @include('dashboard.courses.partials.student-table', [
                                'enrolled' => $course->enrolled,
                            ])

                            <div class="py-5 px-2">

                                <a class="toggle-enroll-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    New Enroll
                                </a>

                            </div>

                        </div>

                        <div x-show="tab == 'watch-resources'">

                            @include('dashboard.courses.partials.resource-table', ['type' => 'watch'])

                            <div class="py-5 px-2">

                                <a class="toggle-upload-watch-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="watch" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Upload 'Watch' Resource
                                </a>

                                <a class="toggle-embed-watch-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="watch" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Embed 'Watch' Resource
                                </a>

                                <a class="toggle-assign-watch-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="watch" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Assign 'Watch' Resource
                                </a>

                            </div>

                        </div>

                        <div x-show="tab == 'read-resources'">

                            @include('dashboard.courses.partials.resource-table', ['type' => 'read'])

                            <div class="py-5 px-2">

                                <a class="toggle-upload-read-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="read" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Upload 'Read' Resource
                                </a>

                                <a class="toggle-embed-read-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="read" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Embed 'Read' Resource
                                </a>

                                <a class="toggle-assign-read-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="read" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Assign 'Read' Resource
                                </a>

                            </div>

                        </div>

                        <div x-show="tab == 'listen-resources'">

                            @include('dashboard.courses.partials.resource-table', ['type' => 'listen'])

                            <div class="py-5 px-2">

                                <a class="toggle-upload-listen-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="listen" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Upload 'Listen' Resource
                                </a>

                                <a class="toggle-embed-listen-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="listen" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Embed 'Listen' Resource
                                </a>

                                <a class="toggle-assign-listen-resource-modal mb-3 ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    data-course="{{ $course->id }}" data-type="listen" href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Assign 'Listen' Resource
                                </a>

                            </div>

                        </div>

                        <div x-show="tab == 'mcqs'">

                            @include('dashboard.courses.partials.mcqs-table', [
                                'enrolled' => $course->enrolled,
                                'mcqs' => $course->multipleChoiceQuestionSets,
                            ])

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="enroll-learner" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Enroll Learner

            </div>

            <div class="p-5">

                @livewire('courses.enroll', [route('dashboard.courses.view', [$course->id, 'tab' => 'students']), $course])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="assign-read-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Assign 'Read' Resource

            </div>

            <div class="p-5">

                @livewire('courses.assign-resource', [route('dashboard.courses.view', [$course->id, 'tab' => 'read-resources']), $course, 'read'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="upload-read-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Upload 'Read' Resource</div>

                <div class="toggle-upload-read-resource-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('courses.upload-resource', ['course' => $course, 'type' => 'read'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="embed-read-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Embed 'Read' Resource</div>

                <div class="toggle-upload-read-resource-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('courses.embed-resource', ['course' => $course, 'type' => 'read'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="assign-watch-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Assign 'Watch' Resource

            </div>

            <div class="p-5">

                @livewire('courses.assign-resource', [route('dashboard.courses.view', [$course->id, 'tab' => 'watch-resources']), $course, 'watch'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="upload-watch-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Upload 'Watch' Resource</div>

                <div class="toggle-upload-watch-resource-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('courses.upload-resource', ['course' => $course, 'type' => 'watch'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="embed-watch-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Embed 'Watch' Resource</div>

                <div class="toggle-upload-watch-resource-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('courses.embed-resource', ['course' => $course, 'type' => 'watch'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="assign-listen-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Assign 'Listen' Resource

            </div>

            <div class="p-5">

                @livewire('courses.assign-resource', [route('dashboard.courses.view', [$course->id, 'tab' => 'listen-resources']), $course, 'listen'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="upload-listen-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Upload 'Listen' Resource</div>

                <div class="toggle-upload-listen-resource-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('courses.upload-resource', ['course' => $course, 'type' => 'listen'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="embed-listen-resource" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 flex justify-between border-b px-5 pb-5 text-center text-xl text-brand-500">

                <div>Embed 'Listen' Resource</div>

                <div class="toggle-upload-listen-resource-modal cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

            </div>

            <div class="p-5">

                @livewire('courses.embed-resource', ['course' => $course, 'type' => 'listen'])

            </div>

        </div>

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="assign-mcq-modal" style="z-index:99;">

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                Assign MCQ

            </div>

            <div class="p-5">

                @livewire('courses.assign-mcq', ['course' => $course])

            </div>

        </div>

    </div>

    <script>
        var btns = document.querySelectorAll('.toggle-enroll-modal');

        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector('#enroll-learner').classList.toggle('hidden');
            });
        }

        @foreach (['read', 'watch', 'listen'] as $type)
            var btns = document.querySelectorAll('.toggle-assign-{{ $type }}-resource-modal');

            for (let i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function(e) {
                    e.preventDefault();
                    document.querySelector('#assign-{{ $type }}-resource').classList.toggle('hidden');
                });
            }
            var btns = document.querySelectorAll('.toggle-embed-{{ $type }}-resource-modal');

            for (let i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function(e) {
                    e.preventDefault();
                    document.querySelector('#embed-{{ $type }}-resource').classList.toggle('hidden');
                });
            }

            var btns = document.querySelectorAll('.toggle-upload-{{ $type }}-resource-modal');

            for (let i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function(e) {
                    e.preventDefault();
                    document.querySelector('#upload-{{ $type }}-resource').classList.toggle('hidden');
                });
            }
        @endforeach

        var btns = document.querySelectorAll('.toggle-assign-mcq-modal');

        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector('#assign-mcq-modal').classList.toggle('hidden');
            });
        }
    </script>
@endsection
