@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessment-hub') }}">Assessment Hub</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessment-hub.view', [$assessment->id]) }}">Take Assessment</a>

    </div>
@endsection

@section('title')
    {{ $assessment->getName() }}
@endsection

@section('content')
    <div class="rounded-lg bg-white pt-10 pb-5 shadow">
        @livewire('frontend.assessment', [$assessment])
    </div>
@endsection
