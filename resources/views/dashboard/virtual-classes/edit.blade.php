@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.virtual-classes') }}">Virtual Classes</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.virtual-classes.edit', [$class->id]) }}">Edit Virtual Class</a>

    </div>

@endsection

@section('title') Edit Class - {{ $class->getTitle() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('virtual-classes.manage-class', ['class' => $class])

    </div>

@endsection