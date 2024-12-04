<form wire:submit.prevent="save">

    <div class="mb-10 rounded-lg bg-white p-10 shadow">

        <div class="space-y-8 divide-y divide-gray-200">

            <div>

                <div>

                    <h3 class="text-lg font-medium leading-6 text-gray-900">MCQ</h3>

                    <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the MCQ.</p>

                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <div class="sm:col-span-6">

                        <label class="block text-sm font-medium text-gray-700" for="name"> Name </label>

                        <div class="mt-1">

                            <input
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="name" name="name" type="text" wire:model="set.name">

                        </div>

                        @error('set.name')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="sm:col-span-2">

                        <label class="block text-sm font-medium text-gray-700" for="topic_id"> Topic </label>

                        <div class="mt-1">

                            <select
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="topic_id" name="topic_id" wire:model="set.topic_id">

                                <option value="">-- Choose Topic --</option>

                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach

                            </select>

                            @error('set.topic_id')
                                <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <div class="sm:col-span-2">

                        <label class="block text-sm font-medium text-gray-700" for="subtopic_id"> Subtopic </label>

                        <div class="mt-1">

                            <select
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="subtopic_id" name="topic_id" wire:model="set.subtopic_id">

                                <option value="">-- Choose Subtopic --</option>

                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach

                            </select>

                            @error('set.subtopic_id')
                                <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <div class="sm:col-span-1">

                        <label class="block text-sm font-medium text-gray-700" for="content"> Show Answer Sheet
                        </label>

                        <button aria-checked="false"
                            class="@if ($set->show_answer_sheet) bg-brand-600 @else bg-gray-200 @endif focus:ring-brand-500 relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2"
                            role="switch" type="button" wire:click="toggle('show_answer_sheet')">
                            <span
                                class="@if ($set->show_answer_sheet) translate-x-5 @else translate-x-0 @endif pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                                <span aria-hidden="true"
                                    class="@if ($set->show_answer_sheet) opacity-0 ease-out duration-100 @else opacity-100 ease-in duration-200 @endif absolute inset-0 flex h-full w-full items-center justify-center opacity-100 transition-opacity duration-200 ease-in">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                                    </svg>
                                </span>
                                <span aria-hidden="true"
                                    class="@if ($set->show_answer_sheet) opacity-100 ease-in duration-200 @else opacity-0 ease-out duration-100 @endif absolute inset-0 flex h-full w-full items-center justify-center opacity-0 transition-opacity duration-100 ease-out">
                                    <svg class="text-brand-600 h-3 w-3" fill="currentColor" viewBox="0 0 12 12">
                                        <path
                                            d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                    </svg>
                                </span>
                            </span>
                        </button>

                    </div>

                    <div class="sm:col-span-1">

                        <label class="block text-sm font-medium text-gray-700" for="content"> Show Explanation </label>

                        <button aria-checked="false"
                            class="@if ($set->show_explanation) bg-brand-600 @else bg-gray-200 @endif focus:ring-brand-500 relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2"
                            role="switch" type="button" wire:click="toggle('show_explanation')">
                            <span
                                class="@if ($set->show_explanation) translate-x-5 @else translate-x-0 @endif pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                                <span aria-hidden="true"
                                    class="@if ($set->show_explanation) opacity-0 ease-out duration-100 @else opacity-100 ease-in duration-200 @endif absolute inset-0 flex h-full w-full items-center justify-center opacity-100 transition-opacity duration-200 ease-in">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                                    </svg>
                                </span>
                                <span aria-hidden="true"
                                    class="@if ($set->show_explanation) opacity-100 ease-in duration-200 @else opacity-0 ease-out duration-100 @endif absolute inset-0 flex h-full w-full items-center justify-center opacity-0 transition-opacity duration-100 ease-out">
                                    <svg class="text-brand-600 h-3 w-3" fill="currentColor" viewBox="0 0 12 12">
                                        <path
                                            d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                    </svg>
                                </span>
                            </span>
                        </button>

                    </div>

                    <div class="sm:col-span-1">

                        <label class="block text-sm font-medium text-gray-700" for="time_type"> Time Type </label>

                        <div class="mt-1">

                            <select
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="time_type" name="time_type" wire:model="set.time_type">

                                <option value="">-- Choose Time Type --</option>

                                @foreach ($time_types as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach

                            </select>

                            @error('set.time_type')
                                <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <div class="sm:col-span-1">

                        <label class="block text-sm font-medium text-gray-700" for="time_allowed"> Time Allowed
                            (Minutes) </label>

                        <div class="mt-1">

                            <input
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="time_allowed" name="time_allowed" type="text" wire:model="set.time_allowed">

                        </div>

                        @error('set.time_allowed')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="sm:col-span-1">

                        <label class="block text-sm font-medium text-gray-700" for="minimum_percentage"> Minimum
                            Percentage </label>

                        <div class="mt-1">

                            <input
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="minimum_percentage" name="minimum_percentage" type="text"
                                wire:model="set.minimum_percentage">

                        </div>

                        @error('set.minimum_percentage')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="sm:col-span-1">

                        <label class="block text-sm font-medium text-gray-700" for="active"> Status </label>

                        <div class="mt-1">

                            <select
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                id="active" name="active" wire:model="set.active">

                                <option value="">-- Choose Type --</option>

                                <option value="1">Active</option>

                                <option value="0">Draft</option>

                            </select>

                            @error('set.active')
                                <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="relative rounded-lg bg-white p-5 shadow">

        @foreach ($questions as $index => $question)
            <div class="relative mb-6 rounded-lg bg-gray-200 p-5">

                <div class="absolute right-0 mr-5 w-5 cursor-pointer hover:text-red-500"
                    wire:click="removeQuestion('{{ $index }}')">
                    <svg class="h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>

                <h3 class="pb-5 text-lg font-medium leading-6 text-gray-900">Question {{ $index + 1 }}</h3>

                <div class="mb-6">

                    <label class="block text-sm font-medium text-gray-700" for="question-{{ $index }}">
                        Question </label>

                    <div class="mt-1">

                        <input
                            class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                            id="question-{{ $index }}" type="text"
                            wire:model="questions.{{ $index }}.question">

                    </div>

                    @error('questions.{{ $index }}.question')
                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-6">

                    <label class="block text-sm font-medium text-gray-700" for="explanation-{{ $index }}">
                        Explanation </label>

                    <div class="mt-1 bg-white" wire:ignore>

                        <div id="wysiwyg-{{ $index }}">{!! $question['explanation'] !!}</div>

                        <script>
                            var editor = new Quill('#wysiwyg-{{ $index }}', {
                                modules: {
                                    toolbar: [
                                        [{
                                            header: [1, 2, false]
                                        }],
                                        ['bold', 'italic', 'underline'],
                                        ['image', 'code-block']
                                    ]
                                },
                                placeholder: '',
                                theme: 'snow',
                            });

                            editor.on('text-change', function(delta, oldDelta, source) {
                                @this.set('questions.{{ $index }}.explanation', editor.root.innerHTML);
                            });
                        </script>

                    </div>

                    @error('questions.{{ $index }}.explanation')
                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                    @enderror

                </div>

                <div class="grid-cols-3 gap-8 md:grid">

                    <div class="mb-6">

                        <label class="block text-sm font-medium text-gray-700" for="type-{{ $index }}"> Type
                        </label>

                        <div class="mt-1">

                            <select
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="type-{{ $index }}" wire:model="questions.{{ $index }}.type">
                                <option value="">-- Choose Type --</option>
                                <option value="multiple">Multiple Choice</option>
                                <option value="short">Short Answer</option>
                                <option value="long">Long Answer</option>
                            </select>

                        </div>

                        @error('questions.{{ $index }}.type')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-6">

                        <label class="block text-sm font-medium text-gray-700" for="marks-{{ $index }}"> Marks
                        </label>

                        <div class="mt-1">

                            <input
                                class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                id="marks-{{ $index }}" type="text"
                                wire:model="questions.{{ $index }}.marks">

                        </div>

                        @error('questions.{{ $index }}.marks')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-6">

                        <label class="block text-sm font-medium text-gray-700" for="content"> Image </label>

                        @if ($question['image_path'])
                            <img class="mb-6 h-64 max-w-full" src="{{ $question['image_url'] }}">
                        @endif

                        <div class="relative max-w-sm">

                            <div class="bg-brand-500 rounded px-6 py-2 font-bold text-white">
                                @if ($question['file'])
                                    {{ $question['file']->getClientOriginalName() }}
                                @else
                                    Choose File
                                @endif
                            </div>

                            <input class="absolute left-0 top-0 h-full w-full opacity-0"
                                name="image-{{ $index }}" type="file"
                                wire:model="questions.{{ $index }}.file" />

                        </div>

                    </div>

                </div>

                @if ($question['type'] == 'multiple')
                    <h3 class="pb-5 text-lg font-medium leading-6 text-gray-900">Answers</h3>

                    <div class="grid-cols-3 gap-8 md:grid">

                        @foreach ($question['answers'] as $answer_index => $answer)
                            <div class="flex items-center gap-5 rounded bg-gray-300 py-3 pl-5 pr-2">
                                <div class="w-full">
                                    <label class="block text-sm font-medium text-gray-700"> Answer
                                        {{ $answer_index + 1 }} </label>
                                    <input
                                        class="focus:border-brand-500 focus:ring-brand-500 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm"
                                        type="text"
                                        wire:model="questions.{{ $index }}.answers.{{ $answer_index }}.answer">
                                </div>
                                <div class="w-16 text-right">
                                    <label class="block text-sm font-medium text-gray-700"> Correct? </label>
                                    <input type="checkbox"
                                        wire:model="questions.{{ $index }}.answers.{{ $answer_index }}.is_correct">
                                </div>
                                <div class="w-5 cursor-pointer hover:text-red-500"
                                    wire:click="removeAnswer('{{ $index }}', '{{ $answer_index }}')">
                                    <svg class="h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="text-right">
                        <button
                            class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 mt-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                            type="button" wire:click="addAnswer({{ $index }})">Add Answer</button>
                    </div>
                @endif

            </div>
        @endforeach

        <button
            class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 mt-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
            type="button" wire:click="addQuestion">Add Question</button>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a class="focus:ring-brand-500 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2"
                href="{{ route('dashboard.courses.mcqs') }}">Cancel</a>

            <button
                class="bg-brand-500 hover:bg-brand-700 focus:ring-brand-500 ml-3 inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
                type="submit">Save</button>

        </div>

    </div>

</form>
