@extends('layouts.admin')

@section('title') Add Reflective Journal Question @endsection

@section('content')

    <div class="bg-white rounded-lg shadow p-10">

        @livewire('reflective-journal.manage-step', ['step' => null])

    </div>

@endsection