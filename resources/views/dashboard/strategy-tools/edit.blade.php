@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles.edit', [$article->id]) }}">Edit Article</a>

    </div>

@endsection

@section('title') Edit Article - {{ $article->getTitle() }} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('strategy-tools.manage-article', ['article' => $article])

    </div>

@endsection