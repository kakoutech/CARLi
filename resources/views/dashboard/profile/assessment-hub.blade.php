@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessment-hub') }}">Assessment Hub</a>

    </div>
@endsection

@section('title')
    Assessment Hub
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-12 text-center md:grid-cols-3">

        <a href="{{ route('dashboard.my-competency-tests') }}">
            <div class="flex items-center justify-center rounded bg-white p-10 shadow">
                <div>
                    <div class="text-brand-500 mt-4 mb-5 border-b pb-5 text-2xl font-bold">Test Your Knowledge</div>
                    <div class="text-lg text-gray-600">Multiple choice questions, to assess your knowledge before and
                        after
                        training.
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('dashboard.my-competency-tests') }}">
            <div class="flex items-center justify-center rounded bg-white p-10 shadow">
                <div>
                    <div class="text-brand-500 mt-4 mb-5 border-b pb-5 text-2xl font-bold">Confirm Your Competencies</div>
                    <div class="text-lg text-gray-600">Confirm your competencies after training.</div>
                </div>
            </div>
        </a>

        <a href="{{ route('dashboard.assessment-hub.assessments') }}">
            <div class="flex items-center justify-center rounded bg-white p-10 shadow">
                <div>
                    <div class="text-brand-500 mt-4 mb-5 border-b pb-5 text-2xl font-bold">Assess Your Wellbeing</div>
                    <div class="text-lg text-gray-600">You will be prompted to assess your wellbeing at specific
                        intervals.
                    </div>
                </div>
            </div>
        </a>

    </div>
@endsection
