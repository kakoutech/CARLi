<form class="space-y-8 divide-y divide-gray-200" wire:submit.prevent="save">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg font-medium leading-6 text-gray-900">Course</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the article content.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label class="block text-sm font-medium text-gray-700" for="title"> Title </label>

                    <div class="mt-1">

                        <input
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="title" name="title" type="text" wire:model="edit_course.title">

                    </div>

                    @error('edit_course.title')
                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                    @enderror

                </div>

                <div class="sm:col-span-6">

                    <label class="block text-sm font-medium text-gray-700" for="content"> Description </label>

                    <div class="mt-1" wire:ignore>

                        <div id="wysiwyg">{!! $edit_course->description !!}</div>

                        <script>
                            var editor = new Quill('#wysiwyg', {
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
                                @this.set('edit_course.description', editor.root.innerHTML);
                            });
                        </script>

                    </div>

                    @error('edit_course.description')
                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                    @enderror

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="trainer_id"> Trainer </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="trainer_id" name="trainer_id" wire:model="edit_course.trainer_id">

                            <option value="">-- Choose Trainer --</option>

                            @foreach (getTrainers() as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->getFullName() }}</option>
                            @endforeach

                        </select>

                        @error('edit_course.trainer_id')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="duration"> Duration (Minutes) </label>

                    <div class="mt-1">

                        <input
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="duration" name="duration" step="1" type="number"
                            wire:model="edit_course.duration">

                        @error('edit_course.duration')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="content"> Thumbnail </label>

                    @if ($edit_course->thumbnail_path)
                        <img class="mb-6 h-64 max-w-full" src="{{ $edit_course->getThumbnail() }}">
                    @endif

                    <div class="relative max-w-sm">

                        <div class="rounded bg-brand-500 px-6 py-2 font-bold text-white">
                            @if ($thumbnail_file)
                                {{ $thumbnail_file->getClientOriginalName() }}
                            @else
                                Choose File
                            @endif
                        </div>

                        <input class="absolute left-0 top-0 h-full w-full opacity-0" name="thumbnail_file"
                            type="file" wire:model="thumbnail_file" />

                    </div>

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="course_topic_id"> Topic </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="course_topic_id" name="strategy_tool_topic_id" wire:model="edit_course.course_topic_id">

                            <option value="">-- Choose Topic --</option>

                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach

                        </select>

                        @error('edit_course.course_topic_id')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="course_type_id"> Type </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="course_type_id" name="strategy_tool_type_id" wire:model="edit_course.course_type_id">

                            <option value="">-- Choose Type --</option>

                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach

                        </select>

                        @error('edit_course.course_type_id')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="active"> Status </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="active" name="active" wire:model="edit_course.active">

                            <option value="">-- Choose Type --</option>

                            <option value="1">Active</option>

                            <option value="0">Draft</option>

                        </select>

                        @error('edit_course.active')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">

                    <label class="block text-sm font-medium text-gray-700" for="view_scope"> View Scope </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="view_scope" name="view_scope" wire:model="edit_course.view_scope">

                            <option value="">-- Choose Scope --</option>

                            <option value="1">Private</option>

                            <option value="0">Public</option>

                        </select>

                        @error('edit_course.view_scope')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('dashboard.courses') }}">Cancel</a>

            <button
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                type="submit">Save</button>

        </div>

    </div>

</form>
