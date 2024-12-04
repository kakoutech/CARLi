<form class="space-y-8 divide-y divide-gray-200" wire:submit.prevent="assign">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg font-medium leading-6 text-gray-900">Assign Resource</h3>

                <p class="mt-1 text-sm text-gray-500">Choose a course and resource to assign.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label class="block text-sm font-medium text-gray-700" for="course_id"> Course </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="course_id" name="course_id" wire:model="course_id">

                            <option value="">-- Choose Course --</option>

                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->getTitle() }}</option>
                            @endforeach

                        </select>

                        @error('course_id')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-6">

                    <label class="block text-sm font-medium text-gray-700" for="resource_id"> Resource </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="resource_id" name="resource_id" wire:model="resource_id">

                            <option value="">-- Choose Resource --</option>

                            @foreach ($resources as $resource)
                                <option value="{{ $resource->id }}">{{ $resource->getFilename() }}</option>
                            @endforeach

                        </select>

                        @error('resource_id')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="sm:col-span-6">

                    <label class="block text-sm font-medium text-gray-700" for="type"> Type </label>

                    <div class="mt-1">

                        <select
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="type" name="type" wire:model="type">

                            <option value="">-- Choose Type --</option>

                            @foreach ($types as $type)
                                <option value="{{ strtolower($type) }}">{{ $type }}</option>
                            @endforeach

                        </select>

                        @error('type')
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
                href="{{ route('dashboard.courses.view', [$course->id]) }}">Cancel</a>

            <button
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                type="submit">Assign</button>

        </div>

    </div>

</form>
