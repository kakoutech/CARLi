<form wire:submit.prevent="save">

    <div>
        <p>Paste Embed here:</p>

        <textarea
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            rows="10" wire:model="embed"></textarea>
    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <button
                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                type="submit">Embed</button>

        </div>

    </div>


</form>
