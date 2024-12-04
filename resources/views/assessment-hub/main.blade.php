@extends('layouts.app')

@section('head')

    Assessment Hub

@endsection

@section('content')

    <div class="mt-10">

        <div class="container">

            <div class="grid grid-cols-1">

                <a href="{{ route('assessment-hub.personality-assessment') }}" class="bg-white ">

                    <div class="px-5 pb-10">
                    
                        <div class="rounded overflow-hidden shadow-2xl bg-gray-100 relative flex items-center">
                    
                            <div class="w-24 h-24 bg-cover" style="background-image: url('{{ asset('/assets/img/personality-assessment.png') }}');"></div>

                            <div class="px-6 py-4">
                    
                                <div class="font-bold text-xl">Personality Assessment</div>

                                <p class="text-gray-700 text-base">Quas Non Vel Tenetur Libero Eveniet</p>
                    
                            </div>
                    
                        </div>
                    
                    </div>

                </a>

                <a href="{{ route('assessment-hub.resilience-assessment') }}" class="bg-white ">
                    <div class="px-5 pb-10">
                    
                        <div class="rounded overflow-hidden shadow-2xl bg-gray-100 relative flex items-center">

                            <div class="w-24 h-24 bg-cover" style="background-image: url('{{ asset('/assets/img/personality-assessment.png') }}');"></div>

                            <div class="px-6 py-4">
                    
                                <div class="font-bold text-xl">Resilience Assessment</div>
                    
                                <p class="text-gray-700 text-base">Quas Non Vel Tenetur Libero Eveniet</p>

                            </div>
                    
                        </div>
                    
                    </div>
                </a>

                <a href="{{ route('assessment-hub.wellbeing-assessment') }}" class="bg-white ">
                    <div class="px-5 pb-10">
                    
                        <div class="rounded overflow-hidden shadow-2xl bg-gray-100 relative flex items-center">

                            <div class="w-24 h-24 bg-cover" style="background-image: url('{{ asset('/assets/img/personality-assessment.png') }}');"></div>

                            <div class="px-6 py-4">
                    
                                <div class="font-bold text-xl">Wellbeing Assessment</div>

                                <p class="text-gray-700 text-base">Quas Non Vel Tenetur Libero Eveniet</p>
                    
                            </div>
                    
                        </div>
                    
                    </div>
                </a>

            </div>

        </div>

    </div>

@endsection