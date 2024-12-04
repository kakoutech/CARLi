@extends('layouts.admin')

@section('breadcrumbs')

<div class="leading-none">

    <a href="{{ route('dashboard') }}">Home</a>

    <span class="mx-2">|</span>

    <a href="{{ route('dashboard.reflective-journal') }}">Reflective Journal</a>

    <span class="mx-2">|</span>

    <a href="{{ route('dashboard.reflective-journal.edit', [$step->id]) }}">Edit Question</a>

</div>

@endsection

@section('title') Edit Question - {{ $step->title }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('reflective-journal.manage-step', ['step' => $step])

    </div>

@endsection