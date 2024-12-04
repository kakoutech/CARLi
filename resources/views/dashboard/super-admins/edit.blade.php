@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.super-admins') }}">Super Admin</a>

        <span class="mx-2">|</span>
            
        <a href="{{ route('dashboard.super-admins.edit', [$user->id]) }}">Edit Super Admin</a>
        
    </div>

@endsection

@section('title') Edit Super Admin - {{ $user->getFullName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('users.super-admin.manage', ['user' => $user])

    </div>

@endsection