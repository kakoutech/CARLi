@extends('layouts.guest')

@section('content')

    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="logo"/></a>

    <form method="POST" action="{{ route('login') }}" class="login-form">

        @csrf

        <div>

            <label class="sr-only" for="email">Email Address</label>

            <input id="email" placeholder="Email Address" class="input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />

        </div>

        <div class="mt-6">

            <label class="sr-only" for="password">Password</label>

            <input id="password" placeholder="Password" class="input" type="password" name="password" required autocomplete="current-password" />

        </div>

        <div class="flex items-center justify-center mt-4">

            @if (Route::has('password.request'))
            
                <a class="underline text-lg text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>

            @endif

        </div>

        <div class="flex items-center justify-center mt-10">

            <button type="submit" class="block button w-full">Sign In</button>

        </div>

        <div class="flex items-center justify-center mt-6">

            <a href="{{ route('register') }}" class="underline text-lg text-gray-600 hover:text-gray-900">Sign Up</a>

        </div>

    </form>

@endsection