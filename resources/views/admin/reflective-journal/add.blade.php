@extends('layouts.admin')

@section('title') Add Reflective Journal Step @endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">

        @livewire('admin.reflective-journal-steps.manage', ['step' => null])

    </div>

@endsection