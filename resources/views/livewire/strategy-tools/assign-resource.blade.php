<form wire:submit.prevent="assign" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Assign Resource</h3>

                <p class="mt-1 text-sm text-gray-500">Choose an article and resource to assign./p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">
                
                    <label for="article_id" class="block text-sm font-medium text-gray-700"> Article </label>
                
                    <div class="mt-1">
                
                        <select wire:model="article_id" id="article_id" name="article_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose article --</option>
                
                            @foreach ($articles as $article)
                
                            <option value="{{ $article->id }}">{{ $article->getTitle() }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('article_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-6">

                    <label for="resource_id" class="block text-sm font-medium text-gray-700"> Resource </label>

                    <div class="mt-1">

                        <select wire:model="resource_id" id="resource_id" name="resource_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                            <option value="">-- Choose Resource --</option>

                            @foreach ($resources as $resource)

                                <option value="{{ $resource->id }}">{{ $resource->getFilename() }}</option>

                            @endforeach

                        </select>

                        @error('resource_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.strategy-tools.articles.view', [$article->id]) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Assign</button>

        </div>

    </div>

</form>