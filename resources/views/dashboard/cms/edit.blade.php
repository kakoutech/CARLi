@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.cms') }}">CMS</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.cms.edit', [$page->id]) }}">Edit Page</a>

    </div>

@endsection

@section('title') Edit Page - {{ $page->getName() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('cms.pages.manage', ['page' => $page])

    </div>

@endsection