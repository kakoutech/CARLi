@extends('layouts.admin')

@section('breadcrumbs')
    <div class="leading-none">

        <a href="{{ route('dashboard') }}">Home</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification') }}">Gamification</a>

        <span class="mx-2">|</span>

        <a href="{{ route('dashboard.gamification.settings') }}">Settings</a>

    </div>
@endsection

@section('title')
    Gamification Settings
@endsection

@section('content')
    <form method="POST">

        @csrf

        @foreach ($groups as $group)
            <div class="mb-6">

                <div class="items-center justify-between rounded-t-lg bg-brand-500 px-3 py-3 md:flex">

                    <div class="flex flex-col justify-center pl-3 text-white">
                        <div class="mb-5 text-xl font-bold leading-none md:mb-0">
                            {{ $group->getName() }}
                        </div>
                    </div>

                </div>

                <div class="rounded-b-lg bg-white p-10 shadow">

                    @foreach ($group->settings as $setting)
                        <div class="mb-5 flex items-center gap-2 border-b pb-5">

                            <div class="mr-10">
                                <input @if ($setting->active) checked @endif class="h-6 w-6"
                                    name="settings[{{ $setting->slug }}][active]" type="checkbox" value="true">
                            </div>

                            @if ($setting->input_count == 0)
                                {{ $setting->pre_text }}
                                {{ $setting->post_text }}
                            @elseif ($setting->input_count == 1)
                                {{ $setting->pre_text }}

                                <input class="w-24 py-1" min="0" name="settings[{{ $setting->slug }}][value]"
                                    step="1" type="number" value="{{ $setting->value }}" />

                                {{ $setting->post_text }}
                            @elseif ($setting->input_count == 2)
                                <input class="w-24 py-1" min="0" name="settings[{{ $setting->slug }}][value]"
                                    step="1" type="number" value="{{ $setting->value }}" />
                                {{ $setting->pre_text }}
                                <input class="w-24 py-1" min="0" name="settings[{{ $setting->slug }}][value_2]"
                                    step="1" type="number" value="{{ $setting->value_2 }}" />
                                {{ $setting->post_text }}
                            @endif

                        </div>
                    @endforeach

                </div>

            </div>
        @endforeach

        <div class="pt-5">

            <div class="flex justify-end">

                <a class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    href="{{ route('dashboard.gamification.badges') }}">Cancel</a>

                <button
                    class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    type="submit">Save</button>

            </div>

        </div>

    </form>
@endsection
