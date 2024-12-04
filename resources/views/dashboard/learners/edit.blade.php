@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners') }}">Learners</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.learners.edit', [$user->id]) }}">Edit Learner</a>

    </div>

@endsection

@section('title') Edit Learner - {{ $user->getFullName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('users.learner.manage', ['user' => $user])

    </div>

@endsection