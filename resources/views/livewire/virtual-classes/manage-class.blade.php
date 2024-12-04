<form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Virtual Class</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update your virtual class.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label for="title" class="block text-sm font-medium text-gray-700"> Title </label>

                    <div class="mt-1">

                        <input wire:model="edit_class.title" type="text" name="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_class.title') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-6">

                    <label for="content" class="block text-sm font-medium text-gray-700"> Description </label>

                    <div wire:ignore class="mt-1">

                        <div id="wysiwyg">{!! $edit_class->description !!}</div>

                        <script>
                            var editor = new Quill('#wysiwyg', {
                                modules: {
                                    toolbar: [
                                        [{ header: [1, 2, false] }],
                                        ['bold', 'italic', 'underline'],
                                        ['image', 'code-block']
                                    ]
                                },
                                placeholder: '',
                                theme: 'snow',
                            });

                            editor.on('text-change', function(delta, oldDelta, source) {
                                @this.set('edit_class.description', editor.root.innerHTML);
                            });

                        </script>

                    </div>

                    @error('edit_class.description') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-3">
                
                    <label for="trainer_id" class="block text-sm font-medium text-gray-700"> Trainer </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_class.trainer_id" id="trainer_id" name="trainer_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Trainer --</option>
                
                            @foreach (getTrainers() as $trainer)
                
                            <option value="{{ $trainer->id }}">{{ $trainer->getFullName() }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('edit_class.trainer_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-3">
                
                    <label for="content" class="block text-sm font-medium text-gray-700"> Thumbnail </label>
                
                    @if ($edit_class->thumbnail_path)
                    
                        <img class="max-w-full h-64 mb-6" src="{{ $edit_class->getThumbnail() }}">
                    
                    @endif

                    <div class="relative max-w-sm">
                
                        <div class="bg-brand-500 text-white px-6 py-2 rounded font-bold">
                            @if ($thumbnail_file)
                                {{ $thumbnail_file->getClientOriginalName() }}
                            @else
                                Choose File
                            @endif
                        </div>
                
                        <input type="file" name="thumbnail_file" wire:model="thumbnail_file" class="absolute left-0 top-0 w-full h-full opacity-0" />

                    </div>
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="virtual_class_category_id" class="block text-sm font-medium text-gray-700"> Category </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_class.virtual_class_category_id" id="virtual_class_category_id" name="strategy_tool_topic_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Category --</option>
                
                            @foreach ($categories as $category)
                
                            <option value="{{ $category->id }}">{{ $category->getName() }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('edit_class.virtual_class_category_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-3">
                
                    <label for="language_id" class="block text-sm font-medium text-gray-700"> Language </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_class.language_id" id="language_id" name="language_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Language --</option>
                
                            @foreach (getLanguages() as $language)

                                <option value="{{ $language->id }}">{{ $language->name }}</option>

                            @endforeach
                
                        </select>
                
                        @error('edit_class.language_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-6">
                
                    <label for="class_type" class="block text-sm font-medium text-gray-700"> Type </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_class.class_type" id="class_type" name="class_type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Type --</option>
                
                            <option value="single">Single - One-Off</option>
                            <option value="recurring">Recurring</option>
                
                        </select>
                
                        @error('edit_class.class_type') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                @if ($edit_class->class_type == 'single')

                    <div class="bg-gray-100 p-5 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 sm:col-span-6">

                        <div class="sm:col-span-2">
                        
                            <label for="start_date" class="block text-sm font-medium text-gray-700"> Date </label>
                        
                            <div class="mt-1">
                        
                                <input onchange="@this.set('edit_class.start_date', this.value)" type="date" value="{{ $edit_class->start_date ? $edit_class->start_date->format('Y-m-d') : null }}" name="start_date" id="start_date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                                @error('edit_class.start_date') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>

                        <div class="sm:col-span-2">
                        
                            <label for="start_time" class="block text-sm font-medium text-gray-700"> Time </label>
                        
                            <div class="mt-1">
                        
                                <input wire:model="edit_class.start_time" type="time" name="start_time" id="start_time" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                                @error('edit_class.start_time') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>

                        <div class="sm:col-span-2">
                        
                            <label for="duration" class="block text-sm font-medium text-gray-700"> Duration (Minutes) </label>
                        
                            <div class="mt-1">
                        
                                <input wire:model="edit_class.duration" type="number" step="1" name="duration" id="duration" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                                @error('edit_class.duration') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>

                    </div>

                @elseif ($edit_class->class_type == 'recurring')

                    <div class="bg-gray-100 p-5 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 sm:col-span-6">

                        <div class="sm:col-span-2">
                        
                            <label for="recurrence" class="block text-sm font-medium text-gray-700"> Recurrence </label>
                        
                            <div class="mt-1">
                        
                                <select wire:model="edit_class.recurrence" id="recurrence" name="recurrence" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                                    <option value="">-- Choose Recurrence --</option>
                        
                                    @foreach (getVirtualClassRecurrences() as $recurrence_key => $recurrence)
                        
                                        <option value="{{ $recurrence_key }}">{{ $recurrence }}</option>
                        
                                    @endforeach
                        
                                </select>
                        
                                @error('edit_class.recurrence') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>

                        <div class="sm:col-span-2">
                        
                            <label for="start_date" class="block text-sm font-medium text-gray-700"> Start Date </label>
                        
                            <div class="mt-1">
                        
                                <input onchange="@this.set('edit_class.start_date', this.value)" type="date" value="{{ $edit_class->start_date ? $edit_class->start_date->format('Y-m-d') : null }}" name="start_date" id="start_date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                                @error('edit_class.start_date') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>
                        
                        <div class="sm:col-span-2">
                        
                            <label for="start_time" class="block text-sm font-medium text-gray-700"> Time </label>
                        
                            <div class="mt-1">
                        
                                <input wire:model="edit_class.start_time" type="time" name="start_time" id="start_time" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                                @error('edit_class.start_time') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>
                        
                        <div class="sm:col-span-2">
                        
                            <label for="duration" class="block text-sm font-medium text-gray-700"> Duration (Minutes) </label>
                        
                            <div class="mt-1">
                        
                                <input wire:model="edit_class.duration" type="number" step="1" name="duration" id="duration" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                                @error('edit_class.duration') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                            </div>
                        
                        </div>

                        <div class="sm:col-span-2">
                        
                            <label for="recurs_for" class="block text-sm font-medium text-gray-700"> Recurs for  </label>
                        
                            <div class="mt-1 flex">
                        
                                <input wire:model="edit_class.recurs_for" min="1" type="number" name="recurs_for" id="recurs_for" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-l-md">
                                
                                <span class="bg-gray-600 border border-r-0 border-gray-500 rounded-r-md px-3 inline-flex items-center text-white sm:text-sm">
                                    Times
                                </span>
                        
                            </div>
                                @error('edit_class.recurs_for') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                        
                        </div>

                    </div>

                @endif

                <div class="sm:col-span-2">
                
                    <label for="host" class="block text-sm font-medium text-gray-700"> Host URL </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_class.host" type="text" name="host" id="host" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_class.host') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="sm:col-span-2">
                
                    <label for="trainer_password" class="block text-sm font-medium text-gray-700"> Trainer Password </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_class.trainer_password" type="text" name="trainer_password" id="trainer_password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_class.trainer_password') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="sm:col-span-2">
                
                    <label for="attendee_password" class="block text-sm font-medium text-gray-700"> Attendee Password </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_class.attendee_password" type="text" name="attendee_password" id="attendee_password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_class.attendee_password') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="sm:col-span-2">
                
                    <label for="active" class="block text-sm font-medium text-gray-700"> Status </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_class.active" id="active" name="active" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Type --</option>
                
                            <option value="1">Active</option>
                
                            <option value="0">Draft</option>
                
                        </select>
                
                        @error('edit_class.active') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-2">
                
                    <label for="view_scope" class="block text-sm font-medium text-gray-700"> View Scope </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_class.view_scope" id="view_scope" name="view_scope" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Scope --</option>
                
                            <option value="1">Private</option>
                
                            <option value="0">Public</option>
                
                        </select>
                
                        @error('edit_class.view_scope') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.virtual-classes') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

        </div>

    </div>

</form>