@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.super-admins') }}">Super Admin</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.super-admins.settings') }}">Settings</a>

    </div>

@endsection

@section('title') Settings @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">


    </div>

@endsection