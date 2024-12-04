@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification') }}">Gamification</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification.badges') }}">Badges</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.gamification.badges.add', [$badge->id]) }}">Add {{ $badge->getName() }} Badge Level</a>

    </div>

@endsection

@section('title') New {{ $badge->getName() }} Badge Level @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('badges.manage-level', ['badge' => $badge, 'badge_level' => null])

    </div>

@endsection