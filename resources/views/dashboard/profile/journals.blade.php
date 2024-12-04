@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.my-reflective-journal') }}">My Reflective Journal</a>

    </div>
@endsection

@section('title')
    My Reflective Journal
@endsection

@section('content')

    <div class="rounded-lg bg-white shadow">

        <div class="flow-root">

            <div class="flex items-center rounded-t-lg bg-brand-500 text-white">

                <div class="w-full py-2 text-center">

                    <span class="block text-sm font-bold uppercase">Journals</span>

                </div>

            </div>

            @if ($entries && $entries->count())
                <div class="p-10">

                    <div class="grid gap-10 md:grid-cols-3" role="list">

                        @foreach ($entries as $entry)
                            <a href="{{ route('dashboard.my-reflective-journal.view', $entry->id) }}">

                                <div class="">

                                    <div class="relative overflow-hidden rounded bg-gray-100">

                                        <img alt="Journal Entry #{{ $entry->id }}" class="w-full"
                                            src="{{ asset('assets/img/default-reflective-journal-image.jpg') }}">

                                        <div class="px-6 py-4">

                                            <div class="mb-2 text-xl font-bold">Reflective Journal Entry
                                                #{{ $entry->id }}
                                            </div>

                                            <p class="text-base text-gray-700">Journal entry recorded on
                                                {{ $entry->created_at->format('d/m/Y') }} at
                                                {{ $entry->created_at->format('H:i A') }}.</p>

                                        </div>

                                        <div class="px-6 pt-4 pb-2">


                                        </div>

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>
                </div>
            @else
                <div class="m-5">

                    <div class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                        <svg 0 class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No journals found matching
                            your
                            criteria. </span>

                    </div>

                </div>
            @endif

            <div class="mt-8 bg-white">

                {{ $entries->appends($_GET)->links() }}

            </div>

        </div>

    </div>

    @if ($entries->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $entries->links() }}

        </div>
    @endif
@endsection
