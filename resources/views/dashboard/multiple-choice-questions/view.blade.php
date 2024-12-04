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

@section('title') MCQ Set - {{ $set->getName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        
    </div>

@endsection