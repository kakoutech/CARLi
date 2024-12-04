<div class="flow-root">

    <div class="flex items-center bg-gray-200">

        <div class="w-full flex-grow px-4 py-2">
            <span class="block text-sm uppercase font-bold">Name</span>
        </div>

    </div>

    @if ($enrolled && $enrolled->count())

        <div class="divide-y divide-gray-200">

            @foreach ($enrolled as $enroll)
                @php 
                    $user = $enroll->learner; 
                    $user_mcqs = $user->assignedQuestionSets()->where('course_id', '=', $course->id)->get();
                @endphp

                <div class="py-4">

                    <div class="flex items-center">

                        <div class="w-full px-4 flex-grow">

                            <div class="flex items-center justify-start gap-5">

                                <div class="w-16"><img class="h-12 w-12 mx-auto rounded-full" src="{{ $user->getAvatar() }}" alt=""></div>

                                <div class="flex-grow"><a href="{{ route('dashboard.learners.view', [$user->id]) }}" class="text-lg font-bold text-gray-900 truncate">{{ $user->getFullName() }}</a></div>

                                <div class="text-right">
                                    
                                    <div onclick="Livewire.emit('setStudentId', '{{ $user->id }}')" data-student-id="{{ $user->id }}" data-course-id="{{ $course->id }}" class="toggle-assign-mcq-modal inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">Assign MCQ</div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="bg-gray-200 rounded-lg px-5 py-2 my-2 mx-5">
                        
                        @if ($user_mcqs && $user_mcqs->count())

                            <div class="divide-y divide-gray-200">
                                
                                @foreach ($user_mcqs as $mcq)
                                    
                                    <div class="flex gap-8">

                                        <div class="w-full flex-grow py-2">

                                            <div class="text-lg font-bold text-gray-900 truncate">{{ $mcq->mcq->getName() }}</div>

                                        </div>

                                        <div class="flex-grow-0 py-2 flex-shrink-0 text-gray-900">

                                            {{ $mcq->date ? $mcq->date->format('d/m/Y') : '-' }} at {{ $mcq->time }}

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else 

                            <div>No MCQs Set</div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="m-5">

            <div class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center">

                <svg class="mx-auto h-12 w-12 text-gray-400" 0 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>

                <span class="text-gray-400 mt-2 block text-lg font-bold font-mediu"> No learners found matching your criteria. </span>

            </div>

        </div>

    @endif

</div>