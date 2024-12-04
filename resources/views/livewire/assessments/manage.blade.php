<form wire:submit.prevent="save">

    <div class="mb-10 rounded-lg bg-white p-10 shadow">

        <div class="space-y-8 divide-y divide-gray-200">

            <div>

                <div>

                    <h3 class="text-lg font-medium leading-6 text-gray-900">Assessment</h3>

                    <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the Assessment.</p>

                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <div class="sm:col-span-3">

                        <label class="block text-sm font-medium text-gray-700" for="name"> Name </label>

                        <div class="mt-1">

                            <input
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="name" name="name" type="text" wire:model="assessment.name">

                        </div>

                        @error('assessment.name')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="sm:col-span-3">

                        <label class="block text-sm font-medium text-gray-700" for="content"> Image </label>

                        @if ($image_path)
                            <img class="mb-6 h-64 max-w-full"
                                src="{{ substr($image_path, 0, 4) == 'http' ? $image_path : asset(str_replace('public', 'storage', $image_path)) }}">
                        @endif

                        <div class="relative max-w-sm">

                            <div class="bg-brand-500 rounded px-6 py-2 font-bold text-white">
                                @if ($image_file)
                                    {{ $image_file->getClientOriginalName() }}
                                @else
                                    Choose File
                                @endif
                            </div>

                            <input class="absolute left-0 top-0 h-full w-full opacity-0" name="image_file"
                                type="file" wire:model="image_file" />

                        </div>

                    </div>

                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <div class="sm:col-span-6">

                        <label class="block text-sm font-medium text-gray-700" for="description"> Description </label>

                        <div class="mt-1">

                            <textarea
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="description" name="description" type="text" wire:model="assessment.description"></textarea>

                        </div>

                        @error('assessment.description')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="relative rounded-lg bg-white p-5 shadow">

        @foreach ($groups as $index => $group)
            <div class="relative mb-6 rounded-lg bg-gray-200 p-5">

                <h3 class="pb-5 text-lg font-medium leading-6 text-gray-900">Group {{ $index + 1 }}</h3>

                <div class="mb-6">

                    <label class="block text-sm font-medium text-gray-700" for="group-{{ $index }}"> Group Name
                    </label>

                    <div class="mt-1">

                        <input
                            class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                            id="group-{{ $index }}" type="text" wire:model="groups.{{ $index }}.name">

                    </div>

                    @error('groups.{{ $index }}.name')
                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                    @enderror

                </div>

                <h3 class="pb-5 text-lg font-medium leading-6 text-gray-900">Statements</h3>

                <div class="">

                    @foreach ($group['statements'] as $statement_index => $statement)
                        <div class="mb-2 rounded-lg bg-white p-5">

                            <div class="flex gap-5">

                                <div class="w-3/4">

                                    <label class="block text-sm font-medium text-gray-700"
                                        for="group-{{ $index }}-statement-{{ $statement_index }}"> Statement
                                    </label>

                                    <div class="mt-1">

                                        <input
                                            class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                            id="group-{{ $index }}-statement-{{ $statement_index }}"
                                            type="text"
                                            wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.statement">

                                    </div>

                                    @error('groups.{{ $index }}.name')
                                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="w-1/4">

                                    <label class="block text-sm font-medium text-gray-700"
                                        for="group-{{ $index }}-statement-{{ $statement_index }}-scale"> Scale
                                    </label>

                                    <div class="mt-1">

                                        <select
                                            class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                            id="group-{{ $index }}-statement-{{ $statement_index }}-scale"
                                            wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.scale">
                                            <option value="5">5-Scale</option>
                                            <option value="10">10-Scale</option>
                                        </select>

                                    </div>

                                    @error('groups.{{ $index }}.name')
                                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="mt-6">

                                @if ($statement['scale'] == 10)
                                    <div class="gap-2 md:grid"
                                        style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;">
                                        @php $count = 1; @endphp
                                        @while ($count < 11)
                                            <div class="mb-6 rounded-lg border border-gray-400 bg-gray-100 p-2 md:mb-0">

                                                <label class="mb-4 block text-sm font-bold text-gray-700"> Choice
                                                    {{ $count }} </label>

                                                <label class="block text-sm font-medium text-gray-700"> Score </label>
                                                <input
                                                    class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                                    step="any" type="number"
                                                    wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.scale_{{ $count }}">

                                                <label class="mt-4 block text-sm font-medium text-gray-700"> Label
                                                    (optional)
                                                </label>
                                                <input
                                                    class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                                    type="text"
                                                    wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.scale_{{ $count }}_text">

                                                @error('groups.{{ $index }}.name')
                                                    <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">
                                                        {{ $message }}</div>
                                                @enderror

                                            </div>

                                            @php $count++ @endphp
                                        @endwhile
                                    </div>
                                @else
                                    <div class="gap-2 md:grid" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr;">
                                        @php $count = 1; @endphp
                                        @while ($count < 6)
                                            <div class="mb-6 rounded-lg border border-gray-400 bg-gray-100 p-2 md:mb-0">

                                                <label class="mb-4 block text-sm font-bold text-gray-700"> Choice
                                                    {{ $count }} </label>

                                                <label class="block text-sm font-medium text-gray-700"> Score </label>
                                                <input
                                                    class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                                    step="any" type="number"
                                                    wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.scale_{{ $count }}">

                                                <label class="mt-4 block text-sm font-medium text-gray-700"> Label
                                                    (optional) </label>
                                                <input
                                                    class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                                    type="text"
                                                    wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.scale_{{ $count }}_text">

                                                @error('groups.{{ $index }}.name')
                                                    <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">
                                                        {{ $message }}</div>
                                                @enderror

                                                <label class="mt-4 block text-sm font-medium text-gray-700">
                                                    Explanation </label>
                                                <input
                                                    class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                                    type="text"
                                                    wire:model="groups.{{ $index }}.statements.{{ $statement_index }}.scale_{{ $count }}_explanation">

                                                @error('groups.{{ $index }}.explanation')
                                                    <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">
                                                        {{ $message }}</div>
                                                @enderror

                                            </div>

                                            @php $count++ @endphp
                                        @endwhile
                                    </div>
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="text-right">

                    <button
                        class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 mt-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                        type="button" wire:click="addStatement({{ $index }})">Add Statement</button>

                </div>

                <div>

                    <h3 class="pb-5 text-lg font-medium leading-6 text-gray-900">Scoring</h3>

                    @foreach ($group['markings'] as $marking_index => $marking)
                        <div class="mb-2 rounded-lg bg-white p-2">

                            <div class="items-center gap-5 md:flex">

                                <div class="flex-shrink-0 flex-grow-0 md:w-24">

                                    <div class="mb-1 text-xs font-bold text-gray-900">Score From:</div>

                                    <input
                                        class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                        step="any" type="number"
                                        wire:model="groups.{{ $index }}.markings.{{ $marking_index }}.score_from">

                                </div>


                                <div class="flex-shrink-0 flex-grow-0 md:w-24">

                                    <div class="mb-1 text-xs font-bold text-gray-900">Score To:</div>

                                    <input
                                        class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                        step="any" type="number"
                                        wire:model="groups.{{ $index }}.markings.{{ $marking_index }}.score_to">

                                </div>


                                <div class="flex-shrink-0 flex-grow-0 md:w-1/3">
                                    <div class="mb-1 text-xs font-bold text-gray-900">Result</div>

                                    <input
                                        class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                        type="text"
                                        wire:model="groups.{{ $index }}.markings.{{ $marking_index }}.name">

                                </div>

                            </div>

                            <div class="mt-3 items-center gap-5 md:flex">

                                <div class="w-full">
                                    <div class="mb-1 text-xs font-bold text-gray-900">Pre Explanation</div>

                                    <input
                                        class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                        type="text"
                                        wire:model="groups.{{ $index }}.markings.{{ $marking_index }}.pre_explanation">

                                </div>

                                <div class="w-full">
                                    <div class="mb-1 text-xs font-bold text-gray-900">Post Explanation</div>

                                    <input
                                        class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                        type="text"
                                        wire:model="groups.{{ $index }}.markings.{{ $marking_index }}.post_explanation">

                                </div>

                                <div class="mt-6 flex-shrink-0 flex-grow-0 md:mt-0 md:w-10">

                                    <div wire:click="deleteScoring({{ $index }}, {{ $marking_index }})">
                                        <svg class="feather feather-trash-2" fill="none" height="24"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            stroke="currentColor" viewBox="0 0 24 24" width="24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" x2="10" y1="11" y2="17">
                                            </line>
                                            <line x1="14" x2="14" y1="11" y2="17">
                                            </line>
                                        </svg>
                                    </div>

                                </div>

                            </div>

                            @error('groups.{{ $index }}.name')
                                <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                            @enderror

                        </div>
                    @endforeach

                </div>

                <div class="text-right">

                    <button
                        class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 mt-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                        type="button" wire:click="addScoring({{ $index }})">Add Scoring Line</button>

                </div>

            </div>
        @endforeach

        <button
            class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 mt-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
            type="button" wire:click="addGroup">Add Group</button>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a class="focus:ring-brand-500 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2"
                href="{{ route('dashboard.assessments') }}">Cancel</a>

            <button
                class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 ml-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                type="submit">Save</button>

        </div>

    </div>

</form>
