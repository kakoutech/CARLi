<div>

    @if ($notifications && $notifications->count())

        @foreach ($notifications as $notification)
            @php $type = explode('\\', $notification->type); @endphp

            @includeIf('dashboard.notifications.types.' . $type[2], [
                'size' => 'full',
                'hide_dismiss' => false,
            ])
        @endforeach
    @else
        <div class="rounded-b-lg bg-white shadow">

            <div class="flow-root">

                <div class="m-5">

                    <div
                        class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                        <svg 0 class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No steps found matching
                            your criteria. </span>

                    </div>

                </div>

            </div>

        </div>

    @endif

    @if ($notifications->hasPages())
        <div class="mt-6 rounded-lg bg-white px-5 py-6 shadow sm:px-6">

            {{ $notifications->links() }}

        </div>
    @endif

</div>
