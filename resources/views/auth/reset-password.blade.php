@extends('layouts.guest')

@section('content')

    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="logo"/></a>
  
    <form method="POST" action="{{ route('password.update') }}" class="login-form">
    
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
        
            <label class="sr-only" for="email">Email Address</label>
        
            <input id="email" placeholder="Email Address" class="input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
        
        </div>

        <div class="mt-6">
        
            <label class="sr-only" for="password">Password</label>
        
            <input id="password" placeholder="Password" class="input" type="password" name="password" required autocomplete="new-password" />
        
        </div>

        <div class="mt-6">
        
            <label class="sr-only" for="password_confirmation">Password Confirmation</label>
        
            <input id="password_confirmation" placeholder="Password Confirmation" class="input" type="password" name="password_confirmation" required autocomplete="new-password" />
        
        </div>

        <div class="flex items-center justify-center mt-10">
                
            <button type="submit" class="block button w-full">Reset Password</button>
                
        </div>

    </form>

@endsection