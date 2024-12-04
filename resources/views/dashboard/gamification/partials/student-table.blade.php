<div class="flow-root">

    <div class="hidden items-center bg-gray-200 md:flex">

        <div class="w-3/12 flex-grow px-4 py-2">
            <span class="block text-sm font-bold uppercase">Name</span>
        </div>

        <div class="w-3/12 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-sm font-bold uppercase">Email</span>
        </div>

        <div class="w-2/12 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-sm font-bold uppercase">Telephone</span>
        </div>

        <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-sm font-bold uppercase">Status</span>
        </div>

        <div class="/12 w-2 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-right text-sm font-bold uppercase">Actions</span>
        </div>

    </div>

    @if ($learners && $learners->count())

        <div class="divide-y divide-gray-200">

            @foreach ($learners as $_learner)
                @php $learner = $_learner->user; @endphp

                <div class="py-4">

                    <div class="items-center md:flex">

                        <div class="flex-grow px-4 md:w-3/12">

                            <div class="flex items-center justify-start gap-5">

                                <div class="w-16"><img alt="" class="mx-auto h-12 w-12 rounded-full"
                                        src="{{ $learner->getAvatar() }}"></div>

                                <div><a class="truncate text-lg font-bold text-gray-900"
                                        href="{{ route('dashboard.learners.view', [$learner->id]) }}">{{ $learner->getFullName() }}</a>
                                </div>

                            </div>

                        </div>

                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-3/12">

                            <p class="truncate text-sm text-gray-500">{{ $learner->email }}</p>

                        </div>

                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

                            <p class="truncate text-sm text-gray-500">
                                {{ $learner->telephone_number }}
                            </p>

                        </div>

                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

                            @if ($learner->active)
                                <p class="truncate text-sm font-bold text-green-500">Active</p>
                            @else
                                <p class="truncate text-sm font-bold text-red-500">Inactive</p>
                            @endif

                        </div>

                        <div class="flex flex-shrink-0 flex-grow-0 justify-end px-4 md:w-2/12">

                            <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                onclick="if(confirm('Are you sure you want to remove this badge?')) document.getElementById('remove_user_{{ $learner->id }}').submit()">
                                Remove Badge </a>

                            <form
                                action="{{ route('dashboard.gamification.badges.levels.user.remove', [$badge->id, $badge_level->id, $_learner->id]) }}"
                                class="inline" id="remove_user_{{ $learner->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                            </form>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>
    @else
        <div class="m-5">

            <div class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                <svg 0 class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No learners found matching your
                    criteria. </span>

            </div>

        </div>

    @endif

</div>
