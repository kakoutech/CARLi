@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.courses') }}">Tools &amp; Resources</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.courses.resources') }}">Resources</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.courses.resources.add') }}">Upload</a>

    </div>

@endsection

@section('title') Upload Resource @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">
    
        @livewire('courses.upload-resource', ['course' => null])
    
    </div>

@endsection