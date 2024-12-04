@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.strategy-tools.resources') }}">Resources</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.strategy-tools.resources.add') }}">Upload</a>

    </div>

@endsection

@section('title') Upload Resource @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">
    
        @livewire('strategy-tools.upload-resource', ['article' => null])
    
    </div>

@endsection