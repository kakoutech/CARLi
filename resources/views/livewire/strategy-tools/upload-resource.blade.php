<form wire:submit.prevent="save">

    <div class="flex items-center justify-center w-full">

        <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center cursor-pointer">

            <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-brand-400 group-hover:text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />

                </svg>

                <p class="pointer-none text-gray-500 ">

                    <span class="text-sm">Drag and drop</span> files here <br> or <span class="text-brand-600 hover:underline" target="_blank">select a file</span> from your computer

                </p>

            </div>

            <input type="file" wire:model="file" class="hidden">

        </label>

    </div>

</form>