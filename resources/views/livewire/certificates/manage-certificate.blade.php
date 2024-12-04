<div>

    <div class="mb-10 rounded-lg bg-white p-10 shadow">

        <div class="space-y-8 divide-y divide-gray-200">

            <div>

                <div>

                    <h3 class="text-lg font-medium leading-6 text-gray-900">Certificate</h3>

                    <p class="mt-1 text-sm text-gray-500">Fill in the form below to create a certificate.</p>

                </div>

                <div class="mt-6 grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 md:grid">

                    <div class="sm:col-span-6">

                        <label class="block text-sm font-medium text-gray-700" for="name"> Name </label>

                        <div class="mt-1">

                            <input
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                id="name" name="name" type="text" wire:model="certificate.name">

                        </div>

                        @error('certificate.name')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="sm:col-span-6">

                        <label class="block text-sm font-medium text-gray-700" for="content"> Background Image </label>

                        @if ($background_image_path)
                            <img class="mb-6 h-64 max-w-full"
                                src="{{ substr($background_image_path, 0, 4) == 'http' ? $background_image_path : asset(str_replace('public', 'storage', $background_image_path)) }}">
                        @endif

                        <div class="relative max-w-sm">

                            <div class="rounded bg-brand-500 px-6 py-2 font-bold text-white">
                                @if ($background_file)
                                    {{ $background_file->getClientOriginalName() }}
                                @else
                                    Choose File
                                @endif
                            </div>

                            <input class="absolute left-0 top-0 h-full w-full opacity-0" name="background_file"
                                type="file" wire:model="background_file" />

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="grid gap-10 md:grid-cols-2">

        @foreach ($groups as $group => $options)
            <div class="relative rounded-lg bg-white px-10 pt-5 pb-10 shadow">

                <h3 class="pb-5 text-center text-lg font-medium leading-6 text-gray-900">
                    {{ ucwords(str_replace('_', ' ', $group)) }}</h3>

                <div class="grid grid-cols-3 gap-5">

                    @foreach ($options as $option => $values)
                        <div>

                            <label class="block text-sm font-medium text-gray-700" for="host"> {{ $values['name'] }}
                            </label>

                            <div class="mt-1">

                                @if ($values['type'] == 'text')
                                    <div>
                                        <input
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="text" wire:model="certificate.{{ $option }}">
                                    </div>
                                @elseif ($values['type'] == 'number')
                                    <div>
                                        <input
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            step="1" type="number" wire:model="certificate.{{ $option }}">
                                    </div>
                                @elseif ($values['type'] == 'color')
                                    <div>
                                        <input
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            style="height: 38px;" type="color"
                                            wire:model="certificate.{{ $option }}">
                                    </div>
                                @elseif ($values['type'] == 'signature')
                                    <div class="flex">
                                        @if ($signature_image_path)
                                            <img class="h-12 max-w-full"
                                                src="{{ substr($signature_image_path, 0, 4) == 'http' ? $signature_image_path : asset(str_replace('public', 'storage', $signature_image_path)) }}">
                                        @endif

                                        <div class="relative max-w-sm">

                                            <div class="rounded bg-brand-500 px-3 py-1 font-bold text-white">
                                                @if ($signature_file)
                                                    {{ $signature_file->getClientOriginalName() }}
                                                @else
                                                    Choose File
                                                @endif
                                            </div>

                                            <input class="absolute left-0 top-0 h-full w-full opacity-0"
                                                name="signature_file" type="file" wire:model="signature_file" />

                                        </div>

                                    </div>
                                @elseif ($values['type'] == 'boolean')
                                    <div class="absolute right-0 top-0 mx-10 mt-5">
                                        <button aria-checked="false"
                                            class="@if ($certificate->{$option}) bg-indigo-600 @else bg-gray-200 @endif relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            role="switch" type="button" wire:click="toggle('{{ $option }}')">
                                            <span
                                                class="@if ($certificate->{$option}) translate-x-5 @else translate-x-0 @endif pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                                                <span aria-hidden="true"
                                                    class="@if ($certificate->{$option}) opacity-0 ease-out duration-100 @else opacity-100 ease-in duration-200 @endif absolute inset-0 flex h-full w-full items-center justify-center opacity-100 transition-opacity duration-200 ease-in">
                                                    <svg class="h-3 w-3 text-gray-400" fill="none"
                                                        viewBox="0 0 12 12">
                                                        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" stroke="currentColor" />
                                                    </svg>
                                                </span>
                                                <span aria-hidden="true"
                                                    class="@if ($certificate->{$option}) opacity-100 ease-in duration-200 @else opacity-0 ease-out duration-100 @endif absolute inset-0 flex h-full w-full items-center justify-center opacity-0 transition-opacity duration-100 ease-out">
                                                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor"
                                                        viewBox="0 0 12 12">
                                                        <path
                                                            d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </button>

                                    </div>
                                @endif

                            </div>

                            @error('certificate.' . $option)
                                <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                            @enderror

                        </div>
                    @endforeach

                </div>

            </div>
        @endforeach

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('dashboard.certificates') }}">Cancel</a>

            <button
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                type="submit" wire:click="save">Save</button>

        </div>

    </div>

    <h1 class="mb-5 text-lg font-medium leading-6 text-gray-900">Preview</h1>

    <div class="relative w-full overflow-scroll">

        @if ($background_image_path)
            <img src="{{ $background_image_path }}" style="max-width: max-content;" />
        @endif

        @if ($certificate->show_title)
            <div class="absolute"
                style="
                left: {{ $certificate->title_position_x }}px; 
                top: {{ $certificate->title_position_y }}px; 
                color: {{ $certificate->title_font_color }};
                font-size: {{ $certificate->title_font_size }}px;">
                {{ $certificate->title_data }}</div>
        @endif

        @if ($certificate->show_body)
            <div class="absolute"
                style="
                left: {{ $certificate->body_position_x }}px; 
                top: {{ $certificate->body_position_y }}px; 
                color: {{ $certificate->body_font_color }};
                font-size: {{ $certificate->body_font_size }}px;">
                {{ $certificate->body_data }}</div>
        @endif

        @if ($certificate->show_students_name)
            <div class="absolute"
                style="
                left: {{ $certificate->student_name_position_x }}px; 
                top: {{ $certificate->student_name_position_y }}px; 
                color: {{ $certificate->student_name_font_color }};
                font-size: {{ $certificate->student_name_font_size }}px;">
                Joe Bloggs</div>
        @endif

        @if ($certificate->show_date)
            <div class="absolute"
                style="
                        left: {{ $certificate->date_position_x }}px; 
                        top: {{ $certificate->date_position_y }}px; 
                        color: {{ $certificate->date_font_color }};
                        font-size: {{ $certificate->date_font_size }}px;">
                {{ now()->format('dS F Y') }}</div>
        @endif

        @if ($certificate->show_footer)
            <div class="absolute"
                style="
                                left: {{ $certificate->footer_position_x }}px; 
                                top: {{ $certificate->footer_position_y }}px; 
                                color: {{ $certificate->footer_font_color }};
                                font-size: {{ $certificate->footer_font_size }}px;">
                {{ $certificate->footer_data }}</div>
        @endif

        @if ($certificate->show_signature)
            <div class="absolute"
                style="
                                        left: {{ $certificate->signature_position_x }}px; 
                                        top: {{ $certificate->signature_position_y }}px; ">
                <img src="{{ substr($signature_image_path, 0, 4) == 'http' ? $signature_image_path : asset(str_replace('public', 'storage', $signature_image_path)) }}"
                    style="width: {{ $certificate->signature_image_width }}px; height: {{ $certificate->signature_image_height }}px;">

            </div>
        @endif


    </div>

</div>
