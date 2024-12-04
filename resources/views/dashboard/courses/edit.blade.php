@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses') }}">Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses.edit', [$course->id]) }}">Edit Course</a>

    </div>

@endsection

@section('title') Edit Course - {{ $course->getTitle() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('courses.manage-course', ['course' => $course])

    </div>

@endsection