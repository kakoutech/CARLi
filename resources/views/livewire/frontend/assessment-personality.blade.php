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

    <div class="mt-10 bg-gray-100 mx-5 py-10 px-3 md:px-10 rounded">
    
        @foreach ($questions as $index => $question)

            <form wire:submit.prevent="saveStep()">
        
                <div class="@if ($current_question != $index+1) hidden @endif">
        
                    <div class="font-bold text-center text-2xl">{{ $question->question }}</div>
        
                    <div class="text-center mx-auto mt-5 text-lg mb-5">
        
                        @foreach ($question->statements as $statement_index => $statement)
                            
                            <div class="my-6">

                                <div class="text-lg text-center mb-6">{{ $statement->statement }}</div>

                                <div class="md:flex md:gap-10 md:items-center md:justify-center">

                                    <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_1" class="flex items-center gap-5 px-5 md:block bg-white md:py-4 md:px-2 border rounded md::w-full md:h-full cursor-pointer">

                                        <div class="flex justify-center">
                                            
                                            <input type="radio" value="1" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_1" class="w-5 h-5 md:mb-3" required />
                                        
                                        </div>

                                        <div class="h-10 flex justify-center items-center text-xs">Very Inaccurate</div>

                                    </label>

                                    <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_2" class="flex items-center gap-5 px-5 md:block bg-white md:py-4 md:px-2 border rounded md:w-full md:h-full cursor-pointer">

                                        <div class="flex justify-center">
                                            
                                            <input type="radio" value="2" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_2" class="w-5 h-5 md:mb-3" required />
                                        
                                        </div>

                                        <div class="h-10 flex justify-center items-center text-xs">Moderately Inaccurate</div>

                                    </label>

                                    <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_3" class="flex items-center gap-5 px-5 md:block bg-white md:py-4 md:px-2 border rounded md:w-full md:h-full cursor-pointer">

                                        <div class="flex justify-center">
                                            
                                            <input type="radio" value="3" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_3" class="w-5 h-5 md:mb-3" required />
                                        
                                        </div>

                                        <div class="h-10 flex justify-center items-center text-xs">Neither Inaccurate nor Accurate</div>

                                    </label>

                                    <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_4" class="flex items-center gap-5 px-5 md:block bg-white md:py-4 md:px-2 border rounded md:w-full md:h-full cursor-pointer">

                                        <div class="flex justify-center">
                                            
                                            <input type="radio" value="4" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_4" class="w-5 h-5 md:mb-3" required />
                                        
                                        </div>

                                        <div class="h-10 flex justify-center items-center text-xs">Moderately Accurate</div>

                                    </label>

                                    <label for="question_{{ $question->id }}_statement_{{ $statement->id }}_5" class="flex items-center gap-5 px-5 md:block bg-white md:py-4 md:px-2 border rounded md:w-full md:h-full cursor-pointer">

                                        <div class="flex justify-center">
                                            
                                            <input type="radio" value="5" wire:model="questions.{{ $index }}.statements.{{ $statement_index }}.result" name="question_{{ $question->id }}_statement_{{ $statement->id }}" id="question_{{ $question->id }}_statement_{{ $statement->id }}_5" class="w-5 h-5 md:mb-3" required />
                                        
                                        </div>

                                        <div class="h-10 flex justify-center items-center text-xs">Very Accurate</div>

                                    </label>

                                </div>

                            </div>

                            <hr/>

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
                        $total_score = auth()->user()->assessmentPersonalityResults()->where('assessment_personality_id', '=', $question->id)->sum('score');

                        if ($total_score <= 14) {
                            $type = 'low';
                        } elseif ($total_score >= 15 && $total_score <= 22) {
                            $type = 'avg';
                        } elseif ($total_score >= 23) {
                            $type = 'high';
                        }

                        $types[$question->slug] = $type;

                        echo '<div class="flex gap-10 items-center text-lg bg-white border py-2 px-5 justify-between mb-2">';
                        echo '<div class="text-gray-600">' . $question->question . '</div>';
                        echo '<div class="uppercase text-gray-800 font-bold">' . $type . '</div>';
                        echo '</div>';
                    }

                    echo '<div>';

                    if (
                        ($types['sociability-scale'] == 'avg' || $types['sociability-scale'] == 'high') && 
                        ($types['altruism-scale'] == 'avg' || $types['altruism-scale'] == 'high') && 
                        ($types['responsibilitysense-of-duty-scale'] == 'avg' || $types['responsibilitysense-of-duty-scale'] == 'high') && 
                        ($types['stability-scale'] == 'avg' || $types['stability-scale'] == 'high') && 
                        ($types['curiosity-scale'] == 'avg' || $types['curiosity-scale'] == 'high')
                    ) {
                        echo '<div class="mt-4 p-5 bg-green-500 text-white"><div class="text-lg font-bold mb-2">BALANCED</div><div>Average to high score in all traits – neutral and agreeable</div></div>';
                    }

                    if (
                        ($types['sociability-scale'] == 'avg' || $types['sociability-scale'] == 'high') && 
                        ($types['altruism-scale'] == 'avg' || $types['altruism-scale'] == 'high') && 
                        ($types['responsibilitysense-of-duty-scale'] == 'avg' || $types['responsibilitysense-of-duty-scale'] == 'low') && 
                        ($types['stability-scale'] == 'avg' || $types['stability-scale'] == 'high') && 
                        ($types['curiosity-scale'] == 'avg' || $types['curiosity-scale'] == 'high')
                    ) {
                        echo '<div class="mt-4 p-5 bg-green-500 text-white"><div class="text-lg font-bold mb-2">LEADER</div><div>low to average sensitivity, all others avg. to high – Dependable role-model</div></div>';
                    }

                    if (
                        ($types['sociability-scale'] == 'high') &&
                        ($types['altruism-scale'] == 'avg' || $types['altruism-scale'] == 'low') &&
                        ($types['responsibilitysense-of-duty-scale'] == 'avg') &&
                        ($types['stability-scale'] == 'avg' || $types['stability-scale'] == 'low') &&
                        ($types['curiosity-scale'] == 'avg' || $types['curiosity-scale'] == 'low')
                    ) {
                        echo '<div class="mt-4 p-5 bg-green-500 text-white"><div class="text-lg font-bold mb-2">EGOCENTRIC</div><div>avg. sensitivity, high sociability, low to avg. others – self- centered, self-motivated</div></div>';
                    }

                    if (
                        ($types['sociability-scale'] == 'avg') && 
                        ($types['altruism-scale'] == 'avg' || $types['altruism-scale'] == 'high') && 
                        ($types['responsibilitysense-of-duty-scale'] == 'low') && 
                        ($types['stability-scale'] == 'avg' || $types['stability-scale'] == 'high') && 
                        ($types['curiosity-scale'] == 'low')
                    ) {
                        echo '<div class="mt-4 p-5 bg-green-500 text-white"><div class="text-lg font-bold mb-2">CAUTIOUS</div><div>low curiosity and sensitivity, avg. sociability, avg. to high altruism and responsibility – Emotionally stable, respectful</div></div>';
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
