@extends('layouts.app')

@section('head')

    Reflective Journal

@endsection

@section('content')

    <div class="mt-10">

        <div class="container">

            <a href="{{ route('reflective-journal.create') }}" class="block h-full mx-5">

                <div class="pb-10 h-full">

                    <div class="rounded overflow-hidden shadow-2xl py-10 relative flex-grow h-full flex justify-center items-center" style="background: #ffa500;">

                        <div>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 text-white mx-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                            </svg>

                            <h5 class="mt-5 text-2xl font-bold tracking-tight text-white text-center">New Reflective<br /> Journal Entry</h5>

                        </div>


                    </div>

                </div>

            </a>

            <div class="grid md:grid-cols-2">

                @foreach ($entries as $entry) 

                    <a href="{{ route('reflective-journal.edit', $entry->id) }}">
                        
                        <div class="px-5 pb-10">
                        
                            <div class="rounded overflow-hidden shadow-2xl bg-gray-100 relative">
                        
                                <img class="w-full" src="{{ asset('assets/img/default-reflective-journal-image.jpg') }}" alt="Journal Entry #{{ $entry->id }}">
                        
                                <div class="px-6 py-4">
                        
                                    <div class="font-bold text-xl mb-2">Reflective Journal Entry #{{ $entry->id }}</div>
                        
                                    <p class="text-gray-700 text-base">Journal entry recorded on {{ $entry->created_at->format('d/m/Y') }} at {{ $entry->created_at->format('H:i A')}}.</p>
                        
                                </div>
                        
                                <div class="px-6 pt-4 pb-2">
                        
                        
                                </div>
                        
                            </div>
                        
                        </div>

                    </a>

                @endforeach

                <div class="mt-8 bg-white">
                
                    {{ $entries->appends($_GET)->links() }}
                
                </div>

            </div>

        </div>

    </div>

@endsection