@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.virtual-classes') }}">Virtual Classes</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.virtual-classes.view', [$class->id]) }}">View Class</a>

    </div>
@endsection

@section('title')
    Virtual Class Overview - {{ $class->getTitle() }}
@endsection

@section('content')
    <div class="gap-5 md:flex">

        <div class="mb-6 flex-shrink-0 flex-grow-0 md:mb-0 md:w-1/4">

            @include('dashboard.virtual-classes.partials.card')

        </div>

        <div class="flex-grow md:w-3/4">

            <div class="rounded-lg bg-white shadow">

                <div class="" x-data="{ tab: '{{ request()->input('tab') == 'resources' ? 'resources' : 'learners' }}' }">

                    <div class="border-b border-gray-200">

                        <nav aria-label="Tabs" class="-mb-px flex space-x-8">

                            <a @click="tab = 'learners'"
                                :class="{ 'border-indigo-500 text-indigo-600': tab ==
                                    'learners', 'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'learners' }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Attendees

                                <span
                                    :class="{ 'bg-gray-100 text-gray-900': tab !=
                                        'learners', 'bg-indigo-100 text-indigo-600': tab == 'learners' }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">
                                    {{ $class->getAttendeeCount() }}</span>

                            </a>

                        </nav>

                    </div>

                    <div>

                        <div x-show="tab == 'learners'">

                            @include('dashboard.virtual-classes.partials.student-table', [
                                'users' => $class->attendees,
                            ])

                            <div class="py-5 px-2">

                                <a class="toggle-enroll-modal ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    href="#">
                                    <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    New Enroll
                                </a>

                            </div>
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

                @livewire('virtual-classes.enroll', [route('dashboard.virtual-classes.view', [$class->id, 'tab' => 'students']), $class])

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
    </script>
@endsection
