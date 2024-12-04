@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.trainers') }}">Trainers</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.trainers.edit', [$user->id]) }}">Edit Trainer</a>

    </div>

@endsection

@section('title') Edit Trainer - {{ $user->getFullName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('users.trainer.manage', ['user' => $user])

    </div>

@endsection