@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.trainers') }}">Trainers</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.trainers.view', [$user->id]) }}">View Trainer</a>

    </div>
@endsection

@section('title')
    View Trainer - {{ $user->getFullName() }}
@endsection

@section('content')
    <div class="gap-5 md:flex">

        <div class="mb-6 flex-shrink-0 flex-grow-0 md:mb-0 md:w-1/4">

            @include('dashboard.trainers.partials.card')

        </div>

        <div class="flex-grow md:w-3/4">

            <div class="rounded-lg bg-white shadow">

                <div class="" x-data="{ tab: '{{ request()->input('tab') == 'resources' ? 'resources' : 'learners' }}' }">

                    <div class="border-b border-gray-200">

                        <nav aria-label="Tabs" class="-mb-px flex space-x-8">

                            <a @click="tab = 'learners'"
                                :class="{
                                    'border-indigo-500 text-indigo-600': tab ==
                                        'learners',
                                    'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab !=
                                        'learners'
                                }"
                                class="flex whitespace-nowrap border-b-2 py-4 px-5 text-sm font-medium" href="#">

                                Learners

                                <span
                                    :class="{
                                        'bg-gray-100 text-gray-900': tab !=
                                            'learners',
                                        'bg-indigo-100 text-indigo-600': tab == 'learners'
                                    }"
                                    class="ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">
                                    {{ $user->getLearnerCount() }}</span>

                            </a>

                        </nav>

                    </div>

                    <div>

                        <div x-show="tab == 'learners'">

                            @include('dashboard.trainers.partials.student-table', [
                                'users' => $user->learners,
                            ])

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
