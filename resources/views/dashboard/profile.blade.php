@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

    </div>

@endsection

@section('title') Your Profile @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('users.profile.manage', ['user' => $user])

    </div>

@endsection