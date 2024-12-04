@extends('layouts.admin')

@section('title') New User @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.users.manage', ['user' => null])

    </div>

@endsection