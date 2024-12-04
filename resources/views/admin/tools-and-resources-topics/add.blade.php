@extends('layouts.admin')

@section('title') Add Tools &amp; Resources Topic @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.tools-and-resources-topics.manage', ['topic' => null])

    </div>

@endsection