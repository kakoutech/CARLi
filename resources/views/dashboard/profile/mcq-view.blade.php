@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-competency-tests') }}">My Competency Tests</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-competency-tests') }}">Take Test</a>

    </div>
@endsection

@section('title')
    {{ $mcq->mcq->getName() }}
@endsection

@section('content')
    <div class="rounded-lg bg-white pt-10 pb-5 shadow">
        @livewire('frontend.mcq', [$mcq])
    </div>
@endsection
