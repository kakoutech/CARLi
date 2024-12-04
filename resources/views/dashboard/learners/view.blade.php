@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners') }}">Learners</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.view', [$user->id]) }}">View Learner</a>

    </div>
@endsection

@section('title')
    View Learner - {{ $user->getFullName() }}
@endsection

@section('content')
    <div class="mb gap-5 md:flex">

        <div class="mb-6 flex-shrink-0 flex-grow-0 md:mb-0 md:w-1/4">

            @include('dashboard.learners.partials.card')

        </div>

        <div class="flex-grow md:w-3/4">

            <div class="rounded-lg bg-white shadow">

                <div class="" x-data="{ tab: '{{ request()->input('tab') != '' ? request()->input('tab') : 'badges' }}' }">

                    <div class="border-b border-gray-200">

                        <nav aria-label="Tabs" class="md:-mb-px md:flex md:space-x-8">

                            <a @click="tab = 'badges'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'badges',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'badges'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Badges

                            </a>

                            <a @click="tab = 'reflective-journal'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'reflective-journal',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'reflective-journal'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Reflective Journal Submissions

                            </a>

                            <a @click="tab = 'enrolled-courses'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'enrolled-courses',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'enrolled-courses'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Enrolled Courses

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

                            </a>

                            <a @click="tab = 'assessments'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'assessments',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'assessments'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Assessments

                            </a>

                            <a @click="tab = 'certificates'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'certificates',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'certificates'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Certificates

                            </a>

                        </nav>

                    </div>

                    <div>

                        <div x-show="tab == 'reflective-journal'">

                            @include('dashboard.learners.partials.reflective-journal-table', [
                                'entries' => $user->journals,
                            ])

                        </div>

                        <div x-show="tab == 'enrolled-courses'">

                            @include('dashboard.learners.partials.enrolled-courses-table', [
                                'courses' => $user->enrolled,
                            ])

                        </div>

                        <div x-show="tab == 'badges'">

                            @include('dashboard.learners.partials.badge-table', [
                                'badges' => $user->badges,
                            ])

                        </div>

                        <div x-show="tab == 'mcqs'">

                            @include('dashboard.learners.partials.mcqs-table', [
                                'mcqs' => $user->assignedQuestionSets,
                            ])

                        </div>

                        <div x-show="tab == 'assessments'">

                            @include('dashboard.learners.partials.assessments-table', [
                                'responses' => $user->assessmentResponses,
                            ])

                        </div>

                        <div x-show="tab == 'certificates'">

                            @include('dashboard.learners.partials.certificate-table', [
                                'certificates' => $user->certificates,
                            ])

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
