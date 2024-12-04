<div class="w-full rounded-lg bg-white shadow">

    <div class="p-5">

        <div><img class="mx-auto max-w-full object-cover" src="{{ $user->getAvatar() }}" /></div>

        <div class="mb-5 mt-10 border-b">

            <div class="truncate text-lg font-bold text-gray-900">{{ $user->getFullName() }}</div>

        </div>

        <div class="mb-5 border-b">

            <div class="block text-sm font-medium text-gray-700">Email</div>

            <div>

                {{ $user->email }}

            </div>

        </div>


        <div class="mb-5 border-b">

            <div class="block text-sm font-medium text-gray-700">Trainer</div>

            <div>

                @if ($user->trainer)
                    <a class="font-bold text-brand-500" href="{{ route('dashboard.trainers.view', $user->trainer_id) }}"
                        title="View Trainer">{{ $user->trainer->getFullName() }}</a>
                @else
                    (no trainer)
                @endif

            </div>

        </div>

        <div class="mb-5 border-b">

            <div class="block text-sm font-medium text-gray-700">Telephone Number</div>

            <div>

                {{ $user->telephone_number }}

            </div>

        </div>

        <div class="mb-5 border-b">

            <div class="block text-sm font-medium text-gray-700">Logged In Time</div>

            <div>

                {{ $user->sessions()->sum('minutes') }} Minutes

            </div>

        </div>

        <div class="mb-5 border-b">

            <div class="block text-sm font-medium text-gray-700">Status:</div>

            @if ($user->isActive())
                <div>
                    <p class="truncate text-sm font-medium text-green-500">Active</p>
                </div>
            @else
                <div>
                    <p class="truncate text-sm font-medium text-red-500">Draft</p>
                </div>
            @endif

        </div>

        <div class="">

            <div class="block text-sm font-medium text-gray-700">Actions:</div>

            <div>

                <a class="cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                    href="{{ route('dashboard.learners.edit', [$user->id]) }}"> Edit </a>

                <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                    onclick="if(confirm('Are you sure you want to delete this learner?')) document.getElementById('delete_user_{{ $user->id }}').submit()">
                    Delete </a>

                <form action="{{ route('dashboard.learners.delete', [$user->id]) }}" class="inline"
                    id="delete_user_{{ $user->id }}" method="POST">
                    @csrf
                    @method('delete')
                </form>

            </div>

        </div>

    </div>

</div>
