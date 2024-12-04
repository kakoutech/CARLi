<li class="relative">
    <a href="{{ $resource->getPermalink() }}" target="_blank">
        <div
            class="group aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
            <img alt="" class="pointer-events-none h-full w-full object-cover group-hover:opacity-75"
                src="{{ $resource->getThumbnail() }}">
            <button class="absolute inset-0 focus:outline-none" type="button">
                <span class="sr-only">View details for {{ $resource->getFilename() }}</span>
            </button>
        </div>
        <div class="absolute right-0 top-0 m-2 rounded bg-brand-500 px-1 text-xs text-white">
            {{ $resource->getFormat() }}</div>
        <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
            {{ $resource->getFilename() }}</p>
        <p class="pointer-events-none block truncate text-sm font-medium text-gray-900">Uploader:
            {{ $resource->uploader ? $resource->uploader->getFullName() : '(unknown)' }}</p>
        <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ $resource->getSize() }}</p>
    </a>
</li>
