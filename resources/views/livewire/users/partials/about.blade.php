<div class="sm:col-span-6">

    <label for="about" class="block text-sm font-medium text-gray-700"> About </label>

    <div class="mt-1">

        <textarea wire:model="edit_user.about" id="about" name="about" type="about" autocomplete="about" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>

    </div>

    @error('edit_user.about') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

</div>