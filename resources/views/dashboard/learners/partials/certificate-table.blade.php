<div class="flow-root">

    <div class="hidden items-center bg-gray-200 md:flex">

        <div class="w-2/12 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-sm font-bold uppercase">Date Awarded</span>
        </div>

        <div class="w-3/12 flex-grow px-4 py-2">
            <span class="block text-sm font-bold uppercase">Certificate</span>
        </div>

        <div class="w-3/12 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-sm font-bold uppercase">Awarded By</span>
        </div>

        <div class="w-1/12 flex-shrink-0 flex-grow-0 px-4 py-2">
            <span class="block text-right text-sm font-bold uppercase">Actions</span>
        </div>

    </div>

    @if ($certificates && $certificates->count())

        <div class="divide-y divide-gray-200">

            @foreach ($certificates as $certificate)
                @php $data = json_decode($certificate->certificate_data, true); @endphp

                <div class="py-4">

                    <div class="flex items-center">

                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-2/12">

                            <p class="truncate text-sm font-bold text-gray-600">
                                {{ $certificate->created_at->format('d/m/Y') }}</p>

                        </div>

                        <div class="flex-grow px-4 md:w-3/12">

                            <p class="truncate text-lg font-bold text-gray-900">{{ $data['name'] }}</p>

                        </div>

                        <div class="flex-shrink-0 flex-grow-0 px-4 md:w-3/12">

                            <p class="truncate text-sm text-gray-500">

                                @if ($certificate->awardedBy)
                                    {{ $certificate->awardedBy->getFullName() }}
                                @endif

                            </p>

                        </div>

                        <div class="flex flex-shrink-0 flex-grow-0 justify-end px-4 md:w-1/12">

                            <a class="cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                                href="{{ route('dashboard.learners.view.certificate', [$certificate->user_id, $certificate->id]) }}">
                                View </a>

                            <!--<a class="ml-2 cursor-pointer items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50" href="{{ route('dashboard.learners.view.certificate', [$certificate->user_id, $certificate->id, 'download' => true]) }}"> Download </a>--->

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

                <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> No certificates found matching your
                    criteria. </span>

            </div>

        </div>

    @endif

</div>

<div class="py-5 px-2">

    <a class="toggle-award-certificate-{{ $user->id }}-modal ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        href="">
        <svg class="mr-2 -ml-2 h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        Award Certificate
    </a>
</div>

<div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
    id="award-certificate-{{ $user->id }}" style="z-index:99;">

    <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

        <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

            Award Certificate

        </div>

        <div class="p-5">

            @livewire('certificates.award', [null, $user->id])

        </div>

    </div>

</div>

<script>
    var btns = document.querySelectorAll('.toggle-award-certificate-{{ $user->id }}-modal');

    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function(e) {
            e.preventDefault();
            document.querySelector('#award-certificate-{{ $user->id }}').classList.toggle('hidden');
        });
    }
</script>
