@extends('layouts.admin')

@section('title') Edit Page @endsection

@section('subtitle') Manage Page #{{ $page->id}} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.pages.manage', ['page' => $page])

    </div>

@endsection