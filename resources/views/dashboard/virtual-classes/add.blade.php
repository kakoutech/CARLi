@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.virtual-classes') }}">Virtual Classes</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.virtual-classes.add') }}">New Virtual Class</a>

    </div>

@endsection

@section('title') Add Virtual Class @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('virtual-classes.manage-class', ['class' => null])

    </div>

@endsection