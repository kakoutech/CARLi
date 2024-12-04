@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners') }}">Learners</a>

            <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.enrolled') }}">Enrolled Students</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.learners.enrolled.enroll') }}">New Enroll</a>
        
    </div>

@endsection

@section('title') New Enroll @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('courses.enroll', [route('dashboard.learners.enrolled')])

    </div>

@endsection