@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-classes') }}">My Classes</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-classes.view', [$class->id]) }}">View Class</a>

    </div>
@endsection

@section('title')
    Class: {{ $class->class->getTitle() }}
@endsection

@section('content')
    <div class="gap-5 md:flex">

        <div class="mb-6 flex-shrink-0 flex-grow-0 md:mb-0 md:w-1/4">

            <div class="w-full rounded-lg bg-white shadow">

                @include('dashboard.profile.partials.class-card', ['class' => $class->class])

            </div>

        </div>

        <div class="flex-grow md:w-3/4">

            <div class="rounded-lg bg-white shadow">


                <div class="relative overflow-hidden rounded bg-gray-100 shadow-2xl">

                    <img alt="{{ $class->class->getTitle() }}" class="w-full" src="{{ $class->class->getImage() }}">


                    <div class="px-6 py-4 text-center">

                        <div class="mb-2 text-xl font-bold">{{ $class->class->getTitle() }}</div>

                    </div>

                    <hr />

                    <div class="px-6 py-4">

                        {!! $class->class->getDescription() !!}

                    </div>

                    <table class="min-w-full divide-y divide-gray-200">

                        <tbody>

                            <tr class="bg-white">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">Trainer</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $class->class->trainer ? $class->class->trainer->getFullName() : '-' }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">Duration</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $class->class->getDuration() }} Minutes</td>
                            </tr>

                            <tr class="bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    Category
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $class->class->category ? $class->class->category->getName() : '-' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    Language
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $class->class->language ? $class->class->language->getName() : '-' }}
                                </td>
                            </tr>

                            <tr class="bg-white">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">Class Type</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ ucwords($class->class->class_type) }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    @if ($class->class->isRecurring())
                                        Recurrence
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    @if ($class->class->isRecurring())
                                        {{ $class->class->recurrence }}
                                    @endif

                                </td>
                            </tr>


                            <tr class="bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    Date
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $class->class->start_date ? $class->class->start_date->format('d/m/Y') : '-' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    Time
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                    {{ $class->class->start_time ? $class->class->start_time : '-' }}
                            </tr>

                            <tr class="bg-white">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">Host</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    <a href="{{ $class->class->host }}" target="_blank">{{ $class->class->host }}</a>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    Attendee Password
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                    {{ $class->class->attendee_password }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($class->class->hasResources())
                        <div class="px-6 py-4">
                            @foreach ($class->class->resources as $_resource)
                                @php $resource = $_resource->resource; @endphp
                                <div class="my-5 border bg-white p-5">
                                    <div class="mb-5 text-lg font-bold">{{ $resource->getFilename() }}</div>
                                    <div>
                                        @if ($resource->isVideo())
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

                                                <img class="w-full" src="{{ $resource->getFile() }}" />

                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif


                    <div class="mx-6 mt-6">
                        <div class="flex">
                            <a class="flex items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                href="{{ $class->class->host }}">

                                Go To host

                            </a>

                        </div>
                    </div>


                    <div class="px-6 pt-4 pb-2">

                        @if ($class->class->category)
                            <span
                                class="delay-50 mr-2 mb-2 inline-block cursor-pointer rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-gray-100 transition duration-300 ease-in-out hover:bg-red-600">{{ $class->class->category->name }}</span>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
