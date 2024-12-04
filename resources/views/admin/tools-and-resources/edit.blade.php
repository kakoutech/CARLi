@extends('layouts.admin')

@section('title') Edit Tools &amp; Resources Article @endsection

@section('subtitle') Manage Tools &amp; Resources Article #{{ $article->id}} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.tools-and-resources-articles.manage', ['article' => $article])

    </div>

@endsection