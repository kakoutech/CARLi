@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Strategy Tools &amp; Resources</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles') }}">Articles</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.strategy-tools.articles', [$article->slug]) }}">{{ $article->getTitle() }}</a>

    </div>
@endsection

@section('title')
    {{ $article->getTitle() }}
@endsection

@section('content')
    <div class="my-8">

        <div class="flex justify-between px-5 pb-5">

            <a class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('dashboard.strategy-tools') }}">Back to Strategy Tools</a>

        </div>

        <div class="px-5 pb-10">

            <div class="relative overflow-hidden rounded bg-gray-100 shadow-2xl">

                <img alt="{{ $article->getTitle() }}" class="w-full" src="{{ $article->getThumbnail() }}">

                <div class="px-6 py-4 text-center">

                    <div class="mb-2 text-xl font-bold">{{ $article->getTitle() }}</div>

                </div>

                <hr />

                <div class="px-6 py-4">

                    {!! $article->getContent() !!}

                </div>


                <div class="px-6 pt-4 pb-2">

                    @if ($article->topic)
                        <span
                            class="delay-50 mr-2 mb-2 inline-block cursor-pointer rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-gray-100 transition duration-300 ease-in-out hover:bg-red-600">{{ $article->topic->name }}</span>
                    @endif

                </div>

            </div>

        </div>
    </div>
@endsection
