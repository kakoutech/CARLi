@extends('layouts.app')

@section('head')

    My Profile

@endsection

@section('content')

    <div class="mt-10">
    
        <div class="container">

            <img src="{{ asset('assets/img/logo.png') }}" class="logo logo-small" />

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-14">

                <div class="text-center">

                    <h2 class="text-base font-semibold text-brand-500 tracking-wide uppercase">{{ env('APP_NAME') }}</h2>

                    <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Profile</p>

                </div>

            </div>

            <div class="bg-gray-100 mx-5 py-10 px-10 rounded">

                @livewire('frontend.profile', ['user' => $user])
            
            </div>

        </div>

    </div>

@endsection
