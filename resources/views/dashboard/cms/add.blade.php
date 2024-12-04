@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.cms') }}">CMS</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.cms.add') }}">Add Page</a>

    </div>

@endsection

@section('title') Add Page @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('cms.pages.manage', ['page' => null])

    </div>

@endsection