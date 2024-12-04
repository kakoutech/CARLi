<a href="{{ $article->getPermalink() }}">

    <div class="px-5 pb-10">

        <div class="rounded overflow-hidden shadow-2xl bg-gray-100 relative">

            <img style="height: 300px; max-height: 300px; object-fit: cover;" class="w-full" src="{{ $article->getImage() }}" alt="{{ $article->getTitle() }}">

            <div class="absolute right-0 top-0 p-2">

                <span class="inline-block bg-brand-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">{{ $article->getFormat() }}</span>

            </div>

            <div class="px-6 py-4">

                <div class="font-bold text-xl mb-2">{{ $article->getTitle() }}</div>

                <p class="text-gray-700 text-base">{{ $article->getSubtitle() }}</p>

            </div>

            <div class="px-6 pt-4 pb-2">

                @if ($article->topic)

                <span class="inline-block bg-red-500 rounded-full px-3 py-1 text-xs font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">{{ $article->topic->name }}</span>

                @endif

            </div>

        </div>

    </div>

</a>