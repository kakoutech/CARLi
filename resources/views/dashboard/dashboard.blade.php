@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

    </div>
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    @if (auth()->user()->isSuperAdmin())
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Learners</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_learners }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.learners') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Employers</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_employers }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.employers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Trainers</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_trainers }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.trainers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

        </dl>

        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Logged In Time</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_logged_in_time }} Minutes</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.learners') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Courses</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_courses }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.courses') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Articles</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_articles }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.trainers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

        </dl>
    @endif

    @if (auth()->user()->isEmployer())
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Learners</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_learners }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.learners') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Courses</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_courses }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.employers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Trainers</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_trainers }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.trainers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

        </dl>

        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Logged In Time</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_logged_in_time }} Minutes</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.learners') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Articles</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_articles }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.trainers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

        </dl>
    @endif

    @if (auth()->user()->isLearner())
        <style>
            header {
                display: none;
            }

            @media screen and (max-width:768px) {
                .tools {
                    grid-column: 1 / 3;
                    text-align: center;
                    justify-content: center;
                }
            }
        </style>
        <div class="grid grid-cols-2 gap-12 text-center md:grid-cols-5">
            <a class="mx-auto" href="{{ route('dashboard.assessment-hub.view', [1]) }}">
                <img src="{{ asset('assets/img/personality-assessment.png') }}" style="margin: auto; max-width: 150px" />
                <div class="mt-4 text-lg font-bold text-gray-800">Personality Assessment</div>
            </a>
            <a class="mx-auto" href="{{ route('dashboard.my-reflective-journal.new') }}">
                <img src="{{ asset('assets/img/reflective-journal.png') }}" style="margin: auto; max-width: 150px" />
                <div class="mt-4 text-lg font-bold text-gray-800">Reflective Journal</div>
            </a>
            <a class="mx-auto" href="{{ route('dashboard.strategy-tools') }}">
                <img src="{{ asset('assets/img/strategies-tools.png') }}" style="margin: auto; max-width: 150px" />
                <div class="mt-4 text-lg font-bold text-gray-800">Strategies Tools</div>
            </a>
            <a class="mx-auto" href="{{ route('dashboard.assessment-hub') }}">
                <img src="{{ asset('assets/img/assessment-hub.png') }}" style="margin: auto; max-width: 150px" />
                <div class="mt-4 text-lg font-bold text-gray-800">Assessment Hub</div>
            </a>
            <a class="tools mx-auto" href="{{ route('dashboard.my-courses') }}">
                <img src="{{ asset('assets/img/tools-and-resources.png') }}" style="margin: auto; max-width: 150px" />
                <div class="mt-4 text-lg font-bold text-gray-800">Tools and Resources</div>
            </a>
        </div>
    @endif

    @if (auth()->user()->isTrainer())
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Learners</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_learners }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.trainers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Logged In Time</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_logged_in_time }} Minutes</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.learners') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="bg-brand-500 absolute rounded-md p-3">
                        <svg aria-hidden="true" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-800">Total Courses</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $total_courses }}</p>

                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a class="text-brand-600 hover:text-brand-500 font-medium"
                                href="{{ route('dashboard.trainers') }}"> View all</a>
                        </div>
                    </div>
                </dd>
            </div>

        </dl>
    @endif

    <div class="mt-6 grid grid-cols-1 gap-10 md:grid-cols-2">

        <div>

            <div class="mt-2 mb-4 text-2xl font-bold leading-none">Notifications</div>

            <div class="scrollbars show">

                @if ($notifications && $notifications->count())
                    @foreach ($notifications as $notification)
                        @php $type = explode('\\', $notification->type); @endphp

                        @includeIf('dashboard.notifications.types.' . $type[2], [
                            'size' => 'small',
                            'hide_dismiss' => true,
                        ])
                    @endforeach
                @else
                    <div class="m-2 rounded bg-gray-200 p-5 text-center">No Notifications Found.</div>
                @endif

            </div>

            <div class="p-3 text-center font-normal">

                <a class="hover:underline" href="{{ route('dashboard.notifications') }}">Show all
                    Notifications</a>

            </div>

        </div>

        <div>

            <div class="mt-2 mb-4 text-2xl font-bold leading-none">Messages</div>

            <div class="scrollbars show">
                @foreach ($messages as $conversation)
                    @if ($conversation->user)
                        <a href="#">
                            <div class="mt-2 flex w-full flex-shrink-0 items-center rounded bg-white p-2 shadow">
                                <div class="w-24 max-w-full flex-shrink px-2 text-center">
                                    <div class="relative">
                                        <img alt="Avatar" class="mx-auto h-10 w-10 rounded-full"
                                            src="{{ $conversation->user->getAvatar() }}">
                                        <span
                                            class="absolute -bottom-0.5 flex h-3 w-3 justify-center rounded-full border border-white bg-green-500 text-center ltr:right-2 rtl:left-2"
                                            title="online"></span>
                                    </div>
                                </div>
                                <div class="w-3/4 max-w-full flex-shrink px-2">
                                    <div class="text-sm font-bold">{{ $conversation->user->getFullName() }}</div>
                                    <div class="mt-1 text-sm text-gray-500">{{ $conversation->getLastMessagePreview() }}
                                    </div>
                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $conversation->getLastMessageTime() }}

                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach

            </div>
            <div class="p-3 text-center font-normal">

                <a class="hover:underline" href="{{ route('dashboard.messaging') }}">Show all
                    Messages</a>

            </div>

        </div>
    </div>


@endsection
