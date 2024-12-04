<form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Page Content</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the page.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-3">

                    <label for="name" class="block text-sm font-medium text-gray-700"> Page Title </label>

                    <div class="mt-1">

                        <input wire:model="edit_page.name" type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_page.name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-3">

                    <label for="path" class="block text-sm font-medium text-gray-700"> Page Path (Relative to the root domain) </label>

                    <div class="mt-1">

                        <input wire:model="edit_page.path" type="text" name="path" id="path" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_page.path') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-3">
                
                    <label for="subtitle" class="block text-sm font-medium text-gray-700"> Page Subtitle </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_page.subtitle" type="text" name="subtitle" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_page.subtitle') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="sm:col-span-3">
                
                    <label for="active" class="block text-sm font-medium text-gray-700"> Status </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_page.active" id="active" name="active" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Type --</option>
                
                            <option value="1">Active</option>
                
                            <option value="0">Draft</option>
                
                        </select>
                
                        @error('edit_page.active') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-6">

                    <label for="email" class="block text-sm font-medium text-gray-700"> Page Content </label>

                    <div wire:ignore class="mt-1">

                        <div id="wysiwyg">{!! $edit_page->content !!}</div>

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
                                @this.set('edit_page.content', editor.root.innerHTML);
                            });

                        </script>

                    </div>

                    @error('edit_page.email') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.cms') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

        </div>

    </div>

</form>