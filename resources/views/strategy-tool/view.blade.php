@extends('layouts.app')

@section('head')

    {{ $article->getTitle() }}

@endsection

@section('content')

<div class="mt-10">

    <div class="container">

        <div class="my-8">

            <div class="px-5 pb-5 flex justify-between">
            
                <a href="{{ route('strategy-tools') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back to Strategy Tools</a>
            
                @if (auth()->user()->isTrainer())
                                
                    <a href="{{ route('strategy-tools.edit', [$article->slug]) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit Article</a>
                                
                @endif

            </div>

            <div class="px-5 pb-10">
            
                <div class="rounded overflow-hidden shadow-2xl bg-gray-100 relative">

                    <img class="w-full" src="{{ $article->getImage() }}" alt="{{ $article->getTitle() }}">

                    <div class="absolute right-0 top-0 p-2">

                        <span class="inline-block bg-brand-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">{{ $article->getFormat() }}</span>

                    </div>

                    <div class="px-6 py-4 text-center">

                        <div class="font-bold text-xl mb-2">{{ $article->getTitle() }}</div>

                        <p class="text-gray-700 text-base">{{ $article->getSubtitle() }}</p>

                    </div>

                    <hr/>

                    <div class="px-6 py-4">

                        {!! $article->getContent() !!}

                    </div>

                    @if ($article->hasUpload())

                        <div class="px-6 py-4">

                            @if ($article->isVideo())

                                <video class="w-full" controls>

                                    <source src="{{ $article->getFile() }}" type="video/mp4">

                                    Your browser does not support the video element.

                                </video>

                            @elseif ($article->isPdf())

                                <a href="{{ $article->getFile() }}" target="_blank" class="text-center">

                                    <div class="bg-white py-2 px-4 border border-gray-300 inline-block rounded-md shadow-sm text-xl font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">View PDF</div>

                                </a>
                                
                            @elseif ($article->isAudio())
                                
                                <div class="bg-slate-200 p-2 rounded-full my-5">

                                    <audio controls class="w-full">

                                        <source src="{{ $article->getFile() }}">

                                        Your browser does not support the audio element.

                                    </audio>

                                </div>

                            @elseif ($article->isImage())

                                <a href="{{ $article->getFile() }}" target="_blank">

                                    <img src="{{ $article->getFile() }}" class="w-full"/>

                                </a>

                            @endif

                        </div>

                    @endif

                    <div class="px-6 pt-4 pb-2">
            
                        @if ($article->topic)
            
                            <span class="inline-block bg-red-500 rounded-full px-3 py-1 text-xs font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">{{ $article->topic->name }}</span>
            
                        @endif
            
                    </div>
            
                </div>
            
            </div>
        </div>

    </div>

</div>

@endsection