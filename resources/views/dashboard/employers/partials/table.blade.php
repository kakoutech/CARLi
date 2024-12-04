<div class="py-4">

    <div class="items-center md:flex">

        <div class="w-12 flex-shrink-0 flex-grow-0 px-4">
            <input class="select-me" name="select-me[]" type="checkbox" value="{{ $user->id }}">
        </div>

        <div class="flex-grow px-4 md:w-4/12">

            <div class="flex items-center justify-start gap-5">
                <div class="w-16"><img alt="" class="mx-auto h-12 w-12 rounded-full"
                        src="{{ $user->getAvatar() }}"></div>
                <div>
                    <a class="truncate text-lg font-bold text-gray-900"
                        href="{{ route('dashboard.employers.view', [$user->id]) }}">
                        {{ $user->company_name ?: '(unnamed)' }}
                    </a>
                </div>
            </div>

        </div>

        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-3/12">

            <div>{{ $user->getFullName() }}</div>
            <p class="truncate text-sm text-gray-500">{{ $user->email }}</p>

        </div>

        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

            <p class="truncate text-sm text-gray-500">
                {{ $user->telephone_number }}
            </p>

        </div>

        <div class="flex-shrink-0 flex-grow-0 px-4 text-center md:w-1/12">

            <p class="truncate text-sm font-bold text-gray-600">
                {{ $user->getTrainerCount() }}
            </p>

        </div>

        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-1/12">

            @if ($user->active)
                <p class="truncate text-sm font-bold text-green-500">Active</p>
            @else
                <p class="truncate text-sm font-bold text-red-500">Inactive</p>
            @endif

        </div>

        <div class="flex flex-shrink-0 flex-grow-0 justify-end px-4 md:w-1/12">

            <a class="cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                href="{{ route('dashboard.employers.edit', [$user->id]) }}"> Edit </a>

            <a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                onclick="if(confirm('Are you sure you want to delete this employer?')) document.getElementById('delete_user_{{ $user->id }}').submit()">
                Delete </a>

            <form action="{{ route('dashboard.employers.delete', [$user->id]) }}" class="inline"
                id="delete_user_{{ $user->id }}" method="POST">
                @csrf
                @method('delete')
            </form>

        </div>

    </div>

</div>
