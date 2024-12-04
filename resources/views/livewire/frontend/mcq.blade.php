<div>
    <div class="mx-5 mt-10 rounded bg-gray-100 py-10 px-3 md:px-10">

        @foreach ($set->mcq->questions as $index => $question)
            <form wire:submit.prevent="saveStep()">

                <div class="@if ($current_question != $index + 1) hidden @endif">

                    <div class="text-center text-2xl font-bold">{{ $question->question }}</div>

                    <div class="mx-auto mt-5 mb-5 text-center text-lg">

                        @foreach ($question->answers as $answer_index => $answer)
                            <label
                                class="md::w-full flex cursor-pointer items-center gap-5 rounded border bg-white py-2 px-5"
                                for="question_{{ $question->id }}_{{ $answer->id }}">

                                <div class="flex justify-center">

                                    <input class="h-5 w-5" id="question_{{ $question->id }}_{{ $answer->id }}"
                                        name="question_{{ $question->id }}" required type="radio"
                                        value="{{ $answer->id }}"
                                        wire:model="set.mcq.questions.{{ $index }}.user_response" />
                                </div>

                                <div class="text-md flex h-10 items-center justify-center">
                                    {{ $answer->answer }}

                                </div>

                            </label>
                        @endforeach


                    </div>

                    <div class="flex justify-between">

                        <div></div>

                        <div>

                            @if ($index > 0)
                                <button
                                    class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                    type="button" wire:click="prevStep">Back</button>
                            @endif

                            <button
                                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                id="nextStep" type="submit">Continue</button>

                        </div>

                    </div>

                </div>

            </form>
        @endforeach

        @if ($is_complete)
            <div>

                <div class="mb-5 text-center text-2xl font-bold">Your Results:</div>

                @php $running_marks = 0; @endphp
                @foreach ($set->mcq->questions as $index => $question)
                    @php
                        $answer = $set->getAnswer($question);
                        if ($answer->score) {
                            $marks = $question->marks;
                            $running_marks += $question->marks;
                        } else {
                            $marks = 0;
                        }
                    @endphp
                    <div class="m-5">

                        <div
                            class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">


                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <div class="mt-2 block">
                                @if ($answer->score)
                                    <div class="text-lg font-bold text-green-500">CORRECT: {{ $question->question }}
                                        ({{ $marks }} MARKS)
                                    </div>
                                @else
                                    <div class="text-lg font-bold text-red-500">INCORRECT: {{ $question->question }}
                                        ({{ $marks }} MARKS)
                                    </div>
                                @endif
                                <div class="text-md">
                                    Your Answer: {{ $answer->theAnswer->answer }}
                                </div>

                                @if ($set->mcq->show_answer_sheet)
                                    @php $correct_answers = $question->correctAnswers(); @endphp
                                    @if ($correct_answers)
                                        <div class="mt-6 font-bold">Correct Answer(s): @foreach ($correct_answers as $correct_answer)
                                                {{ $correct_answer->answer }}
                                            @endforeach
                                        </div>
                                    @endif
                                @endif

                                @if ($set->mcq->show_explanation)
                                    <div class="mt-5">{{ $question->explanation }}</div>
                                @endif
                            </div>

                        </div>

                    </div>
                @endforeach


                <div class="mb-5 text-center text-2xl font-bold">{{ $running_marks }} TOTAL</div>

            </div>

            <div class="mt-6 flex justify-between gap-3 md:justify-center">

                <a class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                    href="{{ route('home') }}"> Home </a>

                <a class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                    href="{{ route('dashboard') }}"> Dashboard </a>

            </div>
        @endif

    </div>

</div>
