<div class="sm:col-span-3">

    <label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>

    <div class="mt-1">

        <input wire:model="edit_user.email" id="email" name="email" type="email" autocomplete="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

    </div>

    @error('edit_user.email') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

</div>

<div class="sm:col-span-3">

    <label for="telephone_number" class="block text-sm font-medium text-gray-700"> Phone Number </label>

    <div class="mt-1">

        <input wire:model="edit_user.telephone_number" type="tel" name="telephone_number" id="telephone_number" autocomplete="phone_number" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">

    </div>

    @error('edit_user.telephone_number') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

</div>