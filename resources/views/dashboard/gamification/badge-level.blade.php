@extends('layouts.admin')

@section('breadcrumbs')

    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification') }}">Gamification</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification.badges') }}">Badges</a>

        <span class="mx-2">|</span>
                
        <a href="{{ route('dashboard.gamification.badges.levels', [$badge->id, $badge_level->id]) }}">Badge Overview</a>

    </div>

@endsection

@section('title') Badge Overview - {{ $badge_level->getName() }} @endsection

@section('content')

    <div class="flex gap-5">
        
        <div class="w-1/4 flex-grow-0 flex-shrink-0 ">
    
            <div class="bg-white rounded-lg shadow w-full">
    
                <div class="p-5">
                
                    <div><img src="{{ $badge_level->getImage() }}" class="max-w-full mx-auto object-cover" /></div>
                
                    <div class="border-b mb-5 mt-10">
                
                        <div class="text-lg font-bold text-gray-900 truncate">{{ $badge_level->getName() }}</div>
                
                    </div>

                    <div class="border-b mb-5">
                    
                        <div class="block text-sm font-medium text-gray-700">Badge Type:</div>
                    
                        <div>
                            
                            {{ $badge->getName() }}

                        </div>

                    </div>

                    <div class="border-b mb-5">
                    
                        <div class="block text-sm font-medium text-gray-700">Points:</div>
                    
                        <div>
                    
                            {{ $badge_level->getCondition() }} Points
                    
                        </div>
                    
                    </div>

                    <div class="border-b mb-5">
                        
                        <div class="block text-sm font-medium text-gray-700">Status:</div>
                        
                        @if ($badge_level->isActive())
                        
                            <div>
                                <p class="text-sm font-medium text-green-500 truncate">Active</p>
                            </div>
                        
                        @else
                        
                            <div>
                                <p class="text-sm font-medium text-red-500 truncate">Draft</p>
                            </div>
                        
                        @endif
                        
                    </div>

                    <div class="">

                        <div class="block text-sm font-medium text-gray-700">Actions:</div>

                        <div>

                            <a href="{{ route('dashboard.gamification.badges.levels', [$badge->id, $badge_level->id]) }}" class="cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> View </a>

                            <a href="{{ route('dashboard.gamification.badges.levels.edit', [$badge->id, $badge_level->id]) }}" class="ml-2 cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Edit </a>
                            
                            <a onclick="if(confirm('Are you sure you want to delete this level?')) document.getElementById('delete_level_{{ $badge_level->id }}').submit()" href="#" class="cursor-pointer ml-2 items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Delete </a>
                            
                            <form id="delete_level_{{ $badge_level->id }}" method="POST" action="{{ route('dashboard.gamification.badges.levels.delete', [$badge->id, $badge_level->id]) }}" class="inline">
                                @csrf
                                @method('delete')
                            </form>
                        </div>

                    </div>

                </div>
    
            </div>
    
        </div>
    
        <div class="w-3/4 flex-grow">
    
            <div class="bg-white rounded-lg shadow">
                        
                <div x-data="{tab:'{{ request()->input('tab') == 'resources' ? 'resources' : 'learners' }}'}" class="">
            
                    <div class="border-b border-gray-200">
            
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            
                            <a :class="{ 'border-indigo-500 text-indigo-600': tab == 'learners', 'border-transparent text-gray-700 hover:text-gray-800 hover:border-gray-200': tab != 'learners' }" href="#" @click="tab = 'learners'" class=" whitespace-nowrap flex py-4 px-5 border-b-2 font-medium text-sm">
            
                                Learners
            
                                <span :class="{'bg-gray-100 text-gray-900': tab != 'learners', 'bg-indigo-100 text-indigo-600': tab == 'learners'}" class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                    {{ $badge_level->getLearnerCount() }}</span>
            
                            </a>
            
                        </nav>
            
                    </div>
            
                    <div>
            
                        <div x-show="tab == 'learners'">
            
                            @include('dashboard.gamification.partials.student-table', ['learners' => $badge_level->learners])
            
                        </div>
                        
                    </div>
            
                </div>
            
            </div>

        </div>

    </div>

@endsection