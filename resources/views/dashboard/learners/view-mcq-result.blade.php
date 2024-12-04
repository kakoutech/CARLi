@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners') }}">Learners</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.view', [$user->id]) }}">Learner Overview</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.view', [$user->id]) }}">MCQ Result</a>

    </div>
@endsection

@section('title')
    {{ $mcq->mcq->getName() }} Result
@endsection

@section('content')
    <div class="rounded-lg bg-white pt-10 pb-5 shadow">
        @livewire('frontend.mcq', [$mcq])
    </div>
@endsection
