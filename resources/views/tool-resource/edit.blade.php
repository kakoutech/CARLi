@extends('layouts.app')

@section('head')

    Tools &amp; Resources - Edit Content

@endsection

@section('content')

    <div class="mt-10">

        <div class="container">

            <div class="my-8">

                <div class="px-5 pb-5">
                
                    <a href="{{ route('tools-and-resources') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back to Tools and Resources</a>
                
                </div>

                <div class="px-5 pb-10">
                
                    @livewire('admin.tools-and-resources-articles.manage', ['article' => $article])
                
                </div>

            </div>

        </div>

    </div>

@endsection