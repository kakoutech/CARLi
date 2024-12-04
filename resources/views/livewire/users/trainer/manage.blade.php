<form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the user.</p>

            </div>

            @include('livewire.users.partials.photo')

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                @include('livewire.users.partials.name')
                                
                @include('livewire.users.partials.email')
                
                @include('livewire.users.partials.password')

                <div class="sm:col-span-3">
                
                    <label for="employer_id" class="block text-sm font-medium text-gray-700"> Employer </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_user.employer_id" id="employer" name="employer" autocomplete="employer_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @if (auth()->user()->id == $edit_user->id) bg-gray-200 @endif">
                
                            <option value="">-- Choose Employer --</option>
                            
                            @foreach (getEmployers() as $employer)
                                <option value="{{ $employer->id }}">{{ $employer->company_name }}</option>
                            @endforeach
                
                        </select>
                
                        @error('edit_user.employer_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                @include('livewire.users.partials.about')

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.trainers') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

        </div>

    </div>

</form>