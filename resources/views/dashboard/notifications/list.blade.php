@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.notifications') }}">Notifications</a>

    </div>
@endsection

@section('title')
    Notifications
@endsection

@section('content')
    @include('dashboard.notifications.panel')
@endsection
