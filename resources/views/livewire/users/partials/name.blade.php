<div class="sm:col-span-3">

    <label for="first-name" class="block text-sm font-medium text-gray-700"> First name </label>

    <div class="mt-1">

        <input wire:model="edit_user.first_name" type="text" name="first-name" id="first-name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

    </div>

    @error('edit_user.first_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

</div>

<div class="sm:col-span-3">

    <label for="last-name" class="block text-sm font-medium text-gray-700"> Last name </label>

    <div class="mt-1">

        <input wire:model="edit_user.last_name" type="text" name="last-name" id="last-name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

    </div>

    @error('edit_user.last_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

</div>