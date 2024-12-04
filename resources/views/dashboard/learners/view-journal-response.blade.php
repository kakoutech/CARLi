@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners') }}">Learners</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.view', [$user->id]) }}">Learner Overview</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.view', [$user->id, 'tab' => 'reflective-journal']) }}">Reflective
            Journals</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.learners.view.journals.view', [$user->id, $entry->id]) }}">Journal Response</a>

    </div>
@endsection

@section('title')
    {{ $user->getFullName() }} Journal Response
@endsection

@section('content')
    @foreach ($entry->responses as $response)
        @php $step = $response->step; @endphp
        <div class="mb-10 rounded-lg bg-white p-10 shadow">

            <div class="text-xl font-bold">{{ $step->getTitle() }}</div>

            <div class="text-md mx-auto mt-2 mb-2">

                {!! $step->getContent() !!}

            </div>

            <div class="mb-2 mt-5 text-lg font-bold">Response:</div>

            <div class="bg-gray-200 p-5">
                {{ $response->response }}
            </div>

            @if ($response->audio || $response->file)
                <div class="mt-5 rounded border bg-white p-5">

                    <div><b>Response Uploads:</b></div>

                    <div class="p-2">

                        @if ($response->audio)
                            <audio class="w-full" controls id="audio" src="{{ $response->getAudioUrl() }}">

                                <source id="player" src="{{ $response->getAudioUrl() }}">

                                Your browser does not support the audio element.

                            </audio>
                        @endif

                    </div>

                    <div class="p-2">
                        @if ($response->file)
                            <a class="text-brand-500" href="{{ $response->getFileUrl() }}">View Uploaded
                                File</a>
                        @endif
                    </div>

                </div>
            @endif
        </div>
    @endforeach

    </div>
@endsection
