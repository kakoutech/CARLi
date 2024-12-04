<div class="p-5">

    <div><img src="{{ $course->getThumbnail() }}" class="w-full object-cover" /></div>

    <div class="border-b mb-5 mt-10">

        <div class="text-lg font-bold text-gray-900 truncate">{{ $course->getTitle() }}</div>

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


</div>