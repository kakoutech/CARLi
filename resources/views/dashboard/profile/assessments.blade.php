@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessment-hub') }}">Assessment Hub</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessment-hub.assessments') }}">Assessments</a>

    </div>
@endsection

@section('title')
    Assessment Hub
@endsection

@section('content')
    <div class="grid-cols-3 gap-10 md:grid">

        @foreach (auth()->user()->availableAssessments() as $assessment)
            <a class="mt-2 block w-full flex-shrink-0 rounded bg-white shadow hover:bg-gray-100 md:flex"
                href="{{ route('dashboard.assessment-hub.view', [$assessment->id]) }}">

                <div class="relative flex w-full flex-col overflow-hidden rounded">

                    <img class="mx-auto h-64 w-full max-w-full object-cover" src="{{ $assessment->getImage() }}" />

                    <div class="px-6 pt-4 text-xl font-bold">{{ $assessment->name }}</div>

                    <div class="w-full flex-grow px-6 text-base text-gray-700">{{ $assessment->description }}</div>

                    <div class="mt-3 px-6 pb-6">
                        <span
                            class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                            Take Assessment Now</span>
                    </div>

                </div>


            </a>
        @endforeach

    </div>
@endsection
