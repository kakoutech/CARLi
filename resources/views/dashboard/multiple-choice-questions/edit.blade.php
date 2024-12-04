@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses') }}">Tools &amp; Resources</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.courses.mcqs') }}">MCQs</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses.mcqs.edit', [$set->id]) }}">Edit MCQ</a>

    </div>

@endsection

@section('title') Edit MCQ - {{ $set->getName() }} @endsection

@section('content')

    @livewire('multiple-choice-questions.manage-set', ['set' => $set])

@endsection