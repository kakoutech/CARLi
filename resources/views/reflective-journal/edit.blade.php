@extends('layouts.app')

@section('head')

    Reflective Journal

@endsection

@section('content')

    <div class="mt-10">

        <div class="container">

            @livewire('frontend.reflective-journal', ['user' => $user, 'steps' => $journal_steps, 'entry' => $journal_entry])

        </div>

    </div>

@endsection