@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-reflective-journal') }}">My Reflective Journal</a>

    </div>
@endsection

@section('title')
    My Reflective Journal
@endsection

@section('content')
    <div class="rounded-lg bg-white pt-10 pb-5 shadow">

        @livewire('frontend.reflective-journal', ['user' => auth()->user(), 'steps' => $journal_steps, 'entry' => $journal_entry])

    </div>
@endsection
