@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.super-admins') }}">Super Admin</a>

        <span class="mx-2">|</span>
            
        <a href="{{ route('dashboard.super-admins.add') }}">New Super Admin</a>

    </div>

@endsection

@section('title') New Super Admin @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('users.super-admin.manage', ['user' => null])

    </div>

@endsection