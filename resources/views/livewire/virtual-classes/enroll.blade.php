<form wire:submit.prevent="enroll" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Virtual Class Enroll</h3>

                <p class="mt-1 text-sm text-gray-500">Choose a learner to enroll on this virtual class.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label for="student_id" class="block text-sm font-medium text-gray-700"> Learner </label>

                    <div class="mt-1">

                        <select wire:model="student_id" id="student_id" name="student_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                            <option value="">-- Choose Learner --</option>

                            @foreach ($learners as $learner)

                                <option value="{{ $learner->id }}">{{ $learner->getFullName() }}</option>

                            @endforeach

                        </select>

                        @error('student_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                    </div>

                </div>

                <div class="sm:col-span-6">
                
                    <label for="virtual_class_id" class="block text-sm font-medium text-gray-700"> Virtual Class </label>
                
                    <div class="mt-1">
                
                        <select wire:model="virtual_class_id" id="virtual_class_id" name="virtual_class_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Virtual Class--</option>
                
                            @foreach ($virtual_classes as $virtual_class)
                
                                <option value="{{ $virtual_class->id }}">{{ $virtual_class->getTitle() }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('virtual_class_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.virtual-classes.view', [$virtual_class->id]) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Enroll</button>

        </div>

    </div>

</form>