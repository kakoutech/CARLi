@extends('layouts.app')

@section('head')

    Strategy Tool - Add Content

@endsection

@section('content')

    <div class="mt-10">

        <div class="container">

            <div class="my-8">

                <div class="px-5 pb-5">
                
                    <a href="{{ route('strategy-tools.articles') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back to Strategy Tools</a>
                
                </div>

                <div class="px-5 pb-10">
                
                    @livewire('strategy-tools.manage-article', ['article' => null])
                
                </div>

            </div>

        </div>

    </div>

@endsection