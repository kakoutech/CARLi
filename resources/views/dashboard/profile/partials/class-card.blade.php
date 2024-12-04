<div class="p-5">

    <div><img src="{{ $class->getThumbnail() }}" class="w-full object-cover" /></div>

    <div class="border-b mb-5 mt-10">

        <div class="text-lg font-bold text-gray-900 truncate">{{ $class->getTitle() }}</div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Duration:</div>

        <div>

            @if ($class->getDuration()) {{ $class->getDuration() }} Minutes @endif

        </div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Trainer:</div>

        <div>

            @if ($class->trainer)

            <a href="{{ route('dashboard.trainers.view', [$class->trainer_id]) }}" class="text-brand-500 font-bold">{{ $class->trainer->getFullName() }}</a>

            @else

            (not set)

            @endif

        </div>

    </div>

    <div class="border-b mb-5">

        <div class="block text-sm font-medium text-gray-700">Topic:</div>
        <div>@if ($class->category) {{ $class->category->getName() }} @endif</div>

    </div>


</div>