<div>

    <nav aria-label="Progress">

        <ol role="list" class="flex items-center justify-center">

            @foreach ($questions as $index => $question)

                <li class="relative @if ($index+1 < count($questions)) pr-8 sm:pr-20 @endif">

                    @if (($index+1) == $current_question)
                    <div class="absolute inset-0 flex items-center" aria-hidden="true" x-description="Current Step">
                        <div class="h-0.5 w-full bg-gray-200"></div>
                    </div>
                    <a href="#" class="relative w-8 h-8 flex items-center justify-center bg-white border-2 border-brand-600 rounded-full" aria-current="step">
                        <span class="h-2.5 w-2.5 bg-brand-600 rounded-full" aria-hidden="true"></span>
                        <span class="sr-only">Step {{ $index+1 }}</span>
                    </a>
                    @elseif ($current_question > ($index+1))
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-brand-600"></div>
                    </div>
                    <a href="#" class="relative w-8 h-8 flex items-center justify-center bg-brand-600 rounded-full hover:bg-brand-900">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Step {{ $index+1 }}</span>
                    </a>
                    @else
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-gray-200"></div>
                    </div>
                    <a href="#" class="group relative w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full hover:border-gray-400">
                        <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300" aria-hidden="true"></span>
                        <span class="sr-only">Step {{ $index+1 }}</span>
                    </a>
                    @endif
                </li>

            @endforeach

        </ol>

    </nav>

    <div class="mt-10 bg-gray-100 mx-5 py-10 px-5 md:px-10 rounded">

        @foreach ($questions as $index => $question)

        <form wire:submit.prevent="saveStep()">

            <div class="@if ($current_question != $index+1) hidden @endif">

                <div class="font-bold text-center text-2xl">{{ $question->question }}</div>

                <div class="text-center mx-auto mt-5 text-lg mb-5">

                    @foreach ($question->statements as $statement_index => $statement)

                    <div class="my-6">

                        <div class="text-lg text-center mb-6">{{ $statement->statement }}</div>

                        <div class="bg-white py-4 px-10 border rounded w-full h-full cursor-pointer">
                            
                            <div class="flex justify-between mb-5">
                            
                                <div class="flex justify-center items-center text-xs">{{ $statement->low_label }}</div>
                            
                                <div class="flex justify-center items-center text-xs">{{ $statement->high_label }}</div>
                            
                            </div>

                            <div class="flex md:gap-10 items-center justify-between">

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_1" class="">

                                    <div class="flex justify-center">

                                        <input type="radio" value="1" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_1" class="w-5 h-5 mb-3" required />

                                    </div>

                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_2" class="">

                                    <div class="flex justify-center">

                                        <input type="radio" value="2" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_2" class="w-5 h-5 mb-3" required />

                                    </div>

                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_3" class="">

                                    <div class="flex justify-center">

                                        <input type="radio" value="3" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_3" class="w-5 h-5 mb-3" required />

                                    </div>

                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_4" class="">

                                    <div class="flex justify-center">

                                        <input type="radio" value="4" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_4" class="w-5 h-5 mb-3" required />

                                    </div>

                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_5" class="">
                                
                                    <div class="flex justify-center">
                                
                                        <input type="radio" value="5" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_5" class="w-5 h-5 mb-3" required />
                                
                                    </div>
                                
                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_6" class="">
                                
                                    <div class="flex justify-center">
                                
                                        <input type="radio" value="6" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_6" class="w-5 h-5 mb-3" required />
                                
                                    </div>
                                
                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_7" class="">
                                
                                    <div class="flex justify-center">
                                
                                        <input type="radio" value="7" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_7" class="w-5 h-5 mb-3" required />
                                
                                    </div>
                                
                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_8" class="">
                                
                                    <div class="flex justify-center">
                                
                                        <input type="radio" value="8" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_8" class="w-5 h-5 mb-3" required />
                                
                                    </div>
                                
                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_9" class="">
                                
                                    <div class="flex justify-center">
                                
                                        <input type="radio" value="9" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_9" class="w-5 h-5 mb-3" required />
                                
                                    </div>
                                
                                </label>

                                <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_10" class="">

                                    <div class="flex justify-center">

                                        <input type="radio" value="10" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_10" class="w-5 h-5 mb-3" required />

                                    </div>


                                </label>

                            </div>

                        </div>

                    </div>

                    <hr />

                    @endforeach

                </div>

                <div class="flex justify-between">

                    <div></div>

                    <div>

                        @if ($index > 0)

                        <button type="button" wire:click="prevStep" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">Back</button>

                        @endif

                        <button type="submit" id="nextStep" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">Continue</button>

                    </div>

                </div>

            </div>

        </form>

        @endforeach

        @if ($current_question > count($questions))

        <div>

            <div class="font-bold text-center text-2xl mb-5">Your Results:</div>

            @php

            $types = [];

            foreach ($questions as $question) {
                foreach ($question->statements as $statement) {
                    if (!isset($types[$statement->type])) {
                        $types[$statement->type] = 0;
                    }

                    $result = $statement->result(auth()->user());

                    $types[$statement->type] += $result ? $result->answer : 0;
                }

                //Physical Health - Q4 – Min score: 0 / Max score: 10
                //Mental Health – Q5 - Min score: 0 / Max score: 10
                //Functioning – Q6 - Min score: 0 / Max score: 10
                //MAX SCORE = 30
                //LOW = 0– 10
                //min score = 0
                //AVG = 11 – 20 HIGH = 21 - 30
            }

            echo '<div class="mt-4 p-5 bg-green-500 text-white">';
            
            echo '<div class="text-lg font-bold mb-2">Physical Health</div>';
            if ($types['health'] <= 10) {
                echo '<div>Low</div>';
            } elseif ($types['health'] >= 11 && $types['health'] <= 20) {
                echo '<div>AVG</div>';
            } elseif ($types['health'] >= 21) {
                echo '<div>HIGH</div>';
            }

            echo '<hr class="my-5"/>';

            echo '<div class="text-lg font-bold mb-2">Wellbeing</div>';
            if ($types['wellbeing'] <= 30) {
                echo '<div>Low</div>';
            } elseif ($types['wellbeing'] >= 31 && $types['wellbeing'] <= 60) {
                echo '<div>AVG</div>';
            } elseif ($types['wellbeing'] >= 61) {
                echo '<div>HIGH</div>';
            }

            echo '</div>';
            
            @endphp

        </div>

        <div class="flex justify-between md:justify-center gap-3 mt-6">

            <a href="{{ route('home') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500"> Home </a>

            <a href="{{ route('assessment-hub') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500"> Assessment Hub </a>

        </div>

        @endif

    </div>

</div>