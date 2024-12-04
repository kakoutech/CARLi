@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessments') }}">Assessments</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.assessments.edit', [$assessment->id]) }}">Edit Assessment</a>

    </div>

@endsection

@section('title') Edit Assessment - {{ $assessment->getName() }} @endsection

@section('content')

    @livewire('assessments.manage', ['assessment' => $assessment])

@endsection