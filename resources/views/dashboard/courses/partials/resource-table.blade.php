@if (
    $course->resources()->where('type', '=', $type)->get() &&
        $course->resources()->where('type', '=', $type)->get()->count())

    <div class="p-5">

        <ul class="grid grid-cols-4 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-4 lg:grid-cols-4 xl:gap-x-4" role="list">

            @foreach ($course->resources()->where('type', '=', $type)->get() as $course_resource)
                @include('dashboard.course-resources.partials.card', [
                    'resource' => $course_resource->resource,
                ])
            @endforeach

        </ul>

    </div>
@else
    <div class="p-5">

        <div class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

            <svg 0 class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No resources found matching your
                criteria. </span>

        </div>

    </div>

@endif
