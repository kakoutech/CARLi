<form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Article Content</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the article content.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label for="title" class="block text-sm font-medium text-gray-700"> Article Title </label>

                    <div class="mt-1">

                        <input wire:model="edit_article.title" type="text" name="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_article.title') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-6">

                    <label for="subtitle" class="block text-sm font-medium text-gray-700"> Article Subtitle </label>

                    <div class="mt-1">

                        <input wire:model="edit_article.subtitle" type="text" name="subtitle" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_article.subtitle') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-2">
                
                    <label for="tool_resource_topic_id" class="block text-sm font-medium text-gray-700"> Topic </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_article.tool_resource_topic_id" id="tool_resource_topic_id" name="strategy_tool_topic_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Topic --</option>
                
                            @foreach ($topics as $topic)
                
                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('edit_article.tool_resource_topic_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-2">

                    <label for="active" class="block text-sm font-medium text-gray-700"> Status </label>

                    <div class="mt-1">

                        <select wire:model="edit_article.active" id="active" name="active" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                            <option value="">-- Choose Type --</option>

                            <option value="1">Active</option>

                            <option value="0">Draft</option>

                        </select>

                        @error('edit_article.active') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                    </div>

                </div>

                <div class="sm:col-span-2">
                
                    <label for="format" class="block text-sm font-medium text-gray-700"> Format </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_article.format" id="format" name="format" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Format --</option>
                
                            @foreach ($formats as $format)
                
                            <option value="{{ $format }}">{{ $format }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('edit_article.format') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-3">
                
                    <label for="content" class="block text-sm font-medium text-gray-700"> Upload File </label>

                    @if ($edit_article->uploads)
                    
                        @if ($edit_article->isImage())

                            <a href="{{ $edit_article->getFile() }}" class="font-bold mt-6 block" target="_blank">
                                <img src="{{ $edit_article->getFile() }}" class="h-64 mb-6">
                            </a>

                        @else 

                        <div>
                            <a href="{{ $edit_article->getFile() }}" class="inline-block bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4 mb-4" target="_blank">Preview Current File</a>
                        </div>
                        @endif

                    @endif
                    <div class="relative max-w-sm">
                
                        <div class="bg-brand-500 text-white px-6 py-2 rounded font-bold">
                            @if ($file)
                            {{ $file->getClientOriginalName() }}
                            @else
                            Choose File
                            @endif
                        </div>
                
                        <input type="file" name="file" wire:model="file" class="absolute left-0 top-0 w-full h-full opacity-0" />
                    </div>

                </div>

                <div class="sm:col-span-3">
                
                    <label for="content" class="block text-sm font-medium text-gray-700"> Cover Image </label>
                
                    @if ($edit_article->cover)
                    
                        <img class="max-w-full h-64 mb-6" src="{{ $edit_article->getImage() }}">
                    
                    @endif

                    <div class="relative max-w-sm">
                
                        <div class="bg-brand-500 text-white px-6 py-2 rounded font-bold">
                            @if ($cover)
                            {{ $cover->getClientOriginalName() }}
                            @else
                            Choose File
                            @endif
                        </div>
                
                        <input type="file" name="cover" wire:model="cover" class="absolute left-0 top-0 w-full h-full opacity-0" />
                    </div>
                
                </div>

                <div class="sm:col-span-6">

                    <label for="content" class="block text-sm font-medium text-gray-700"> Article Content </label>

                    <div wire:ignore class="mt-1">

                        <div id="wysiwyg">{!! $edit_article->content !!}</div>

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
                                @this.set('edit_article.content', editor.root.innerHTML);
                            });

                        </script>

                    </div>

                    @error('edit_article.content') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            @if (auth()->user()->isTrainer())

                <a href="{{ route('tools-and-resources') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            @else 
            
                <a href="{{ route('admin.tools-and-resources') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            @endif

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

        </div>

    </div>

</form>