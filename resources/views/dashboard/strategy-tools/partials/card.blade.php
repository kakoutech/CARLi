<a href="{{ $article->getPermalink() }}">

    <div class="px-5 pb-10">

        <div class="relative overflow-hidden rounded bg-gray-100 shadow-2xl">

            <img alt="{{ $article->getTitle() }}" class="w-full" src="{{ $article->getThumbnail() }}"
                style="height: 300px; max-height: 300px; object-fit: cover;">

            <div class="absolute right-0 top-0 p-2">


            </div>

            <div class="px-6 py-4">

                <div class="mb-2 text-xl font-bold">{{ $article->getTitle() }}</div>

            </div>

            <div class="px-6 pt-4 pb-2">

                @if ($article->topic)
                    <span
                        class="delay-50 mr-2 mb-2 inline-block cursor-pointer rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-gray-100 transition duration-300 ease-in-out hover:bg-red-600">{{ $article->topic->name }}</span>
                @endif

            </div>

        </div>

    </div>

</a>
