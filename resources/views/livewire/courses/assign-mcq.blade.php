<form wire:submit.prevent="assign" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Assign Multiple Choice Question</h3>

                <p class="mt-1 text-sm text-gray-500">Choose a student and mcq to assign.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">
                
                    <label for="student_id" class="block text-sm font-medium text-gray-700"> Learner </label>
                
                    <div class="mt-1">
                
                        <select wire:model="student_id" id="student_id" name="student_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Learner --</option>
                
                            @foreach ($students as $student)
                                @php $student = $student->learner; @endphp
                
                            <option value="{{ $student->id }}">{{ $student->getFullName() }}</option>
                
                            @endforeach
                
                        </select>
                
                        @error('student_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                <div class="sm:col-span-6">

                    <label for="multiple_choice_question_set_id" class="block text-sm font-medium text-gray-700"> MCQs </label>

                    <div class="mt-1">

                        <select wire:model="multiple_choice_question_set_id" id="multiple_choice_question_set_id" name="multiple_choice_question_set_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                            <option value="">-- Choose MCQ --</option>

                            @foreach ($multiple_choice_question_sets as $multiple_choice_question_set)
                                @php //$multiple_choice_question_set = $multiple_choice_question_set->mcq; @endphp
                                <option value="{{ $multiple_choice_question_set->id }}">{{ $multiple_choice_question_set->getName() }}</option>

                            @endforeach

                        </select>

                        @error('multiple_choice_question_set_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                    </div>

                </div>

                <div class="sm:col-span-3">
                
                    <label for="date" class="block text-sm font-medium text-gray-700"> Date </label>
                
                    <div class="mt-1">
                
                        <input onchange="@this.set('date', this.value)" type="date" value="{{ $date }}" name="start_date" id="start_date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                        @error('date') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="time" class="block text-sm font-medium text-gray-700"> Time </label>
                
                    <div class="mt-1">
                
                        <input wire:model="time" type="time" name="time" id="time" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                        @error('time') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>
            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('dashboard.courses.view', [$course->id, 'tab' => 'mcqs']) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Assign</button>

        </div>

    </div>

</form>