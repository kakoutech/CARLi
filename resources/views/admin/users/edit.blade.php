@extends('layouts.admin')

@section('title') Edit User @endsection

@section('subtitle') Manage User #{{ $user->id}} @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.users.manage', ['user' => $user])

    </div>

@endsection