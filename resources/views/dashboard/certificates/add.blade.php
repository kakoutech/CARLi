@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.certificates') }}">Certificates</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.certificates.add') }}">New Certificate</a>

    </div>

@endsection

@section('title') Add Certificate @endsection

@section('content')

    @livewire('certificates.manage-certificate', ['certificate' => null])

@endsection