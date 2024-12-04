<div class="p-5">

    <div><img src="{{ $course->getThumbnail() }}" class="w-full object-cover" /></div>

    <div class="border-b mb-5 mt-10">
        
        <a href="{{ route('dashboard.courses.view', [$course->id]) }}" class="text-lg font-bold text-gray-900 truncate">{{ $course->getTitle() }}</a>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Duration:</div>

        <div>

            @if ($course->getDuration()) {{ $course->getDuration() }} Minutes @endif

        </div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Trainer:</div>

        <div>

            @if ($course->trainer)

                <a href="{{ route('dashboard.trainers.view', [$course->trainer_id]) }}" class="text-brand-500 font-bold">{{ $course->trainer->getFullName() }}</a>

            @else

                (not set)

            @endif

        </div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Topic:</div>
        <div>@if ($course->topic) {{ $course->topic->getName() }} @endif</div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">View Scope:</div>

        <div>{{ $course->getViewScope() }}</div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Enroll Count:</div>

        <div>{{ $course->getEnrollCount() }}</div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Status:</div>
        
        @if ($course->isActive())

            <div><p class="text-sm font-medium text-green-500 truncate">Active</p></div>

        @else

            <div><p class="text-sm font-medium text-red-500 truncate">Draft</p></div>

        @endif

    </div>

    <div class="">

        <div class="block text-sm font-medium text-gray-700">Actions:</div>
        
        <div>

            <a href="{{ route('dashboard.courses.edit', [$course->id]) }}" class="cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Edit </a>

            <a onclick="if(confirm('Are you sure you want to delete this course?')) document.getElementById('delete_course_{{ $course->id }}').submit()" href="#" class="ml-2 cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Delete </a>

            <form id="delete_course_{{ $course->id }}" method="POST" action="{{ route('dashboard.courses.delete', [$course->id]) }}" class="inline">

                @csrf

                @method('delete')

            </form>

        </div>

    </div>

</div>