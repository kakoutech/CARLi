<div class="sm:col-span-6">

    <label for="first-name" class="block text-sm font-medium text-gray-700"> Permissions </label>

    <div class="mt-6">

        @foreach ($permissions as $group => $actions)
        
            <div class="font-bold mb-6">{{ ucwords(str_replace('-', ' ', $group)) }}</div>

            <div class="flex flex-wrap gap-10 bg-gray-100 w-full p-4 mb-6">

                @foreach ($actions as $action => $value)

                    <label class="flex items-center gap-4">

                        <input type="checkbox" wire:model="permissions.{{ $group }}.{{ $action }}"/>
                        
                        <div class="text-sm">{{ ucwords(str_replace('__', ' ', str_replace($group . '__', '', $action))) }}</div>

                    </label>

                @endforeach

            </div>

        @endforeach
        
    </div>

</div>
