@extends('layouts.admin')

@section('title') Users @endsection

@if (request()->has('search') && request()->input('search'))
    @section('subtitle') Search results for: {{ request()->input('search') }} @endsection
@endif

@section('actions')

    <div class="md:flex gap-3">

        <a href="{{ route('admin.users.add') }}" class="mb-3 md:mb-0 flex bg-white py-2 px-5 rounded-md leading-5 text-gray-800 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 -ml-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New User
        </a>

        <form method="GET" class="relative text-white focus-within:text-gray-600">
            <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center top-0 h-10">
                <svg class="h-5 w-5" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input placeholder="Search Users" class="block w-full bg-white bg-opacity-20 py-2 pl-10 pr-3 border border-transparent rounded-md leading-5 text-white placeholder-white focus:outline-none focus:bg-opacity-100 focus:text-gray-900 focus:border-transparent focus:placeholder-gray-500 focus:ring-0 sm:text-sm" type="search" name="search" value="{{ request()->input('search') }}">
        </form>

    </div>

@endsection

@section('content')

    <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">
        
        <div class="flow-root mt-6">

            @if ($users && $users->count())
            
                <ul role="list" class="-my-5 divide-y divide-gray-200">
            
                    @foreach ($users as $user)

                        <li class="py-4">

                            <div class="flex items-center space-x-4">
                            
                                <div class="flex-shrink-0">
                            
                                    <img class="h-12 w-12 rounded-full" src="{{ $user->getAvatar() }}" alt="">
                            
                                </div>

                                <div class="flex-1 min-w-0">

                                    <p class="text-lg font-bold text-gray-900 truncate">{{ $user->getFullName() }}</p>

                                    <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>

                                    <p class="mt-1 md:hidden text-sm font-medium text-gray-900 truncate">{{ $user->getDisplayRole() }}</p>
                                    
                                </div>
                                
                                <div class=" hidden md:block flex-1 min-w-0">

                                    <div class="text-sm font-medium text-gray-900 truncate">{{ $user->getDisplayRole() }}</div>

                                    <div class="text-sm font-medium text-gray-500 truncate">
                                        @if ($user->account_type == 'learner') 
                                            {{ $user->trainer ? $user->trainer->getFullName() : '' }}
                                        @endif
                                    </div>
                                </div>

                                <div>
                                
                                    <a href="{{ route('admin.users.edit', [$user->id]) }}" class="cursor-pointer inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Edit </a>
                                    
                                    <a onclick="if(confirm('Are you sure you want to delete this user?')) document.getElementById('delete_user_{{ $user->id }}').submit()" class="cursor-pointer inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Delete </a>
                                    
                                    <form id="delete_user_{{ $user->id }}" method="POST" action="{{ route('admin.users.delete', [$user->id]) }}" class="inline">
                                        @csrf
                                        @method('delete')
                                    </form>

                                </div>

                            </div>

                        </li>

                    @endforeach

                </ul>

            @else 

                <div class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center">
                    
                    <svg class="mx-auto h-12 w-12 text-gray-400"0 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    
                    <span class="text-gray-400 mt-2 block text-lg font-bold font-mediu"> No users found matching your criteria. </span>

                </div>

            @endif

        </div>

    </div>

    @if ($users->hasPages())

        <div class="mt-6 bg-white rounded-lg shadow px-5 py-6 sm:px-6">

            {{ $users->links() }}

        </div>

    @endif

@endsection