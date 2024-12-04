@extends('layouts.admin')

@section('title') Edit Strategy Tool Article @endsection

@section('subtitle') Manage Strategy Tool Article #{{ $article->id}} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.strategy-tools-articles.manage', ['article' => $article])

    </div>

@endsection