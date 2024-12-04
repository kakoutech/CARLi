@extends('layouts.guest')

@section('content')

    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="logo"/></a>
  
    <form method="POST" action="{{ route('password.email') }}" class="login-form">

        @csrf

        <div class="bg-gray-200 rounded max-w-4xl mx-auto p-5 md:p-10">

            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.

        </div>

        <div class="mt-10">

            <label class="sr-only" for="email">Email Address</label>

            <input id="email" placeholder="Email Address" class="input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />

        </div>
        
        <div class="flex items-center justify-center mt-10">
                
            <button type="submit" class="block button w-full">Email Password Reset Link</button>
        
        </div>
                
        <div class="flex items-center justify-center mt-6">
        
            <a href="{{ route('login') }}" class="underline text-lg text-gray-600 hover:text-gray-900">Sign In</a>
        
        </div>

    </form>

@endsection