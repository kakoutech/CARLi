@php $data = json_decode($certificate->certificate_data, true); @endphp

@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-certificates') }}">My Certificates</a>

        <span class="mx-2">|</span>
        
        <a href="{{ route('dashboard.my-certificates.view', [$certificate->id]) }}">View Certificate</a>

    </div>

@endsection

@section('title') {{ $data['name'] }}@endsection

@section('content')

@endsection