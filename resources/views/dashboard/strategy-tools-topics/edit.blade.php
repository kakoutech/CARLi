@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.topics') }}">Topics</a>

        <span class="mx-2">|</span>
            
        <a href="{{ route('dashboard.strategy-tools.topics.edit', [$topic->id]) }}">Edit Topic</a>

    </div>

@endsection

@section('title') Edit Topic - {{ $topic->getName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('strategy-tools.manage-topic', ['topic' => $topic])

    </div>

@endsection