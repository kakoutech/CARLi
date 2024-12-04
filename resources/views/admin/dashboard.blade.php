@extends('layouts.admin')

@section('title') Dashboard  @endsection

@section('content')

<div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6" style="min-height: 200px;">
    
    <div>
        <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-2">
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-pink-600 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.users.add') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Create New User</a>
                </div>
            </li>
    
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-purple-600 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.users') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Manage Users</a>
                </div>
            </li>
    
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-yellow-500 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.pages.add') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Create New Page</a>
                </div>
            </li>
    
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-500 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.pages') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Manage Pages</a>
                </div>
            </li>

            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-yellow-500 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.strategy-tools.add') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Create New Strategy Tool Article</a>
                </div>
            </li>
            
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-500 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.strategy-tools') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Manage Strategy Tool</a>
                </div>
            </li>

            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-yellow-500 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.tools-and-resources.add') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Create New Tool &amp; Resources Article</a>
                </div>
            </li>
            
            <li class="col-span-1 flex shadow-sm rounded-md">
                <div class="flex-shrink-0 flex items-center justify-center w-16 bg-green-500 text-white text-sm font-medium rounded-l-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <a href="{{ route('admin.tools-and-resources') }}" class="w-full flex px-6 py-4 text-lg truncate h-16 items-center text-gray-900 hover:text-gray-600">Manage Tools &amp; Resources</a>
                </div>
            </li>
        </ul>
    </div>
</div>


@endsection