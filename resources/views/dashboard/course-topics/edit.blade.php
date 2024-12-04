@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses') }}">Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses.topics') }}">Topics</a>

        <span class="mx-2">|</span>
            
        <a href="{{ route('dashboard.courses.topics.edit', [$topic->id]) }}">Edit Topic</a>

    </div>

@endsection

@section('title') Edit Topic - {{ $topic->getName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('courses.manage-topic', ['topic' => $topic])

    </div>

@endsection