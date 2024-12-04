<form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Manage Question</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the question.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label for="title" class="block text-sm font-medium text-gray-700"> Question </label>

                    <div class="mt-1">

                        <input wire:model="edit_step.title" type="text" name="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_step.title') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-2">

                    <label for="active" class="block text-sm font-medium text-gray-700"> Status </label>

                    <div class="mt-1">

                        <select wire:model="edit_step.active" id="active" name="active" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                            <option value="">-- Choose Type --</option>

                            <option value="1">Active</option>

                            <option value="0">Draft</option>

                        </select>

                        @error('edit_step.active') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">
                
                    <label for="order" class="block text-sm font-medium text-gray-700"> Order </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_step.order" type="number" name="order" id="order" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                        @error('edit_step.order') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-2">
                
                    <label for="accept_input" class="block text-sm font-medium text-gray-700"> User Input </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_step.accept_input" id="accept_input" name="accept_input" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Type --</option>
                
                            <option value="1">Show input fields, and accept input</option>
                
                            <option value="0">Display Only</option>
                
                        </select>
                
                        @error('edit_step.accept_input') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-6">

                    <label for="content" class="block text-sm font-medium text-gray-700"> Description </label>

                    <div wire:ignore class="mt-1">

                        <div id="wysiwyg">{!! $edit_step->content !!}</div>

                        <script>
                            var editor = new Quill('#wysiwyg', {
                                modules: {
                                    toolbar: [
                                        [{ header: [1, 2, false] }],
                                        ['bold', 'italic', 'underline'],
                                        ['image', 'code-block']
                                    ]
                                },
                                placeholder: 'Write your page contents..',
                                theme: 'snow',
                            });

                            editor.on('text-change', function(delta, oldDelta, source) {
                                @this.set('edit_step.content', editor.root.innerHTML);
                            });

                        </script>

                    </div>

                    @error('edit_step.content') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.reflective-journal') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

        </div>

    </div>

</form>