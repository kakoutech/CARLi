<div
    class="@if ($size == 'small') p-2 mt-2 @else p-5 mt-5 @endif w-full flex-shrink-0 items-center rounded bg-white shadow md:flex">

    <div class="mx-auto mb-6 flex h-12 w-12 justify-center rounded-full bg-brand-500 text-white md:mb-0">

        <svg class="bi bi-calendar4-event h-4 w-4 self-center" fill="currentColor" viewBox="0 0 16 16"
            xmlns="http://www.w3.org/2000/svg">

            <path
                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z">
            </path>

            <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"></path>

        </svg>

    </div>

    <div class="@if ($size == 'small') md:pl-5 @else md:pl-10 @endif w-full">

        <div class="flex w-full items-center justify-between">

            <div class="@if ($size == 'small') text-sm @endif focus:outline-none">
