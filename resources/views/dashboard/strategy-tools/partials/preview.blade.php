<div class="p-5">

    <div>
        <img class="max-w-full mx-auto" src="{{ $article->getThumbnail() }}" alt="{{ $article->getTitle() }}">
    </div>

        <div class="px-6 py-4 text-center">

            <div class="font-bold text-xl mb-2">{{ $article->getTitle() }}</div>

        </div>

        <hr />

        <div class="px-6 py-4">

            {!! $article->getContent() !!}

        </div>

        @if ($article->hasResources())

            <h1 class="px-6 font-bold mb-6 text-xl">Resources</h1>

            <div class="px-6 py-4">

                @foreach ($article->resources as $_resource)
    
                    @php $resource = $_resource->resource; @endphp

                    @if ($resource->isVideo())

                        <video class="w-full" controls>

                            <source src="{{ $resource->getFile() }}" type="video/mp4">

                            Your browser does not support the video element.

                        </video>

                    @elseif ($resource->isPdf())

                        <a href="{{ $resource->getFile() }}" target="_blank" class="text-center">

                            <div class="bg-white py-2 px-4 border border-gray-300 inline-block rounded-md shadow-sm text-xl font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">View PDF</div>

                        </a>

                    @elseif ($resource->isAudio())

                        <div class="bg-slate-200 p-2 rounded-full my-5">

                            <audio controls class="w-full">

                                <source src="{{ $resource->getFile() }}">

                                Your browser does not support the audio element.

                            </audio>

                        </div>

                    @elseif ($resource->isImage())

                        <a href="{{ $resource->getFile() }}" target="_blank">

                            <img src="{{ $resource->getFile() }}" class="w-full" />

                        </a>

                    @endif
                    
                @endforeach

            </div>

        @endif

        <div class="px-6 pt-4 pb-2">

            @if ($article->topic)

                <span class="inline-block bg-red-500 rounded-full px-3 py-1 text-xs font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">{{ $article->topic->name }}</span>

            @endif

        </div>


</div>