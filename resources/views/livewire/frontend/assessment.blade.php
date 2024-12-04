<div>

    <nav aria-label="Progress" class="hidden">

        <ol class="flex hidden items-center justify-center" role="list">

            @foreach ($assessment_item->groups as $index => $group)
                <li class="@if ($index + 1 < $assessment_item->groups->count()) pr-8 sm:pr-20 @endif relative">

                    @if ($index + 1 == $current_group)
                        <div aria-hidden="true" class="absolute inset-0 flex items-center" x-description="Current Step">
                            <div class="h-0.5 w-full bg-gray-200"></div>
                        </div>
                        <a aria-current="step"
                            class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 border-brand-600 bg-white"
                            href="#">
                            <span aria-hidden="true" class="h-2.5 w-2.5 rounded-full bg-brand-600"></span>
                            <span class="sr-only">Step {{ $index + 1 }}</span>
                        </a>
                    @elseif ($current_group > $index + 1)
                        <div aria-hidden="true" class="absolute inset-0 flex items-center">
                            <div class="h-0.5 w-full bg-brand-600"></div>
                        </div>
                        <a class="relative flex h-8 w-8 items-center justify-center rounded-full bg-brand-600 hover:bg-brand-900"
                            href="#">
                            <svg aria-hidden="true" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    fill-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Step {{ $index + 1 }}</span>
                        </a>
                    @else
                        <div aria-hidden="true" class="absolute inset-0 flex items-center">
                            <div class="h-0.5 w-full bg-gray-200"></div>
                        </div>
                        <a class="group relative flex h-8 w-8 items-center justify-center rounded-full border-2 border-gray-300 bg-white hover:border-gray-400"
                            href="#">
                            <span aria-hidden="true"
                                class="h-2.5 w-2.5 rounded-full bg-transparent group-hover:bg-gray-300"></span>
                            <span class="sr-only">Step {{ $index + 1 }}</span>
                        </a>
                    @endif
                </li>
            @endforeach

        </ol>

    </nav>

    <div class="mx-5 mt-10 rounded bg-gray-100 py-10 px-3 md:px-10">

        @if (!$is_complete)

            <div class="owl-carousel" wire:ignore.self>

                @foreach ($assessment_item->groups as $index => $group)
                    @foreach ($group->statements as $statement_index => $statement)
                        <div {{-- class="@if ($current_group != $index + 1) hidden @endif" --}} class="w-full">

                            <div class="text-center text-2xl font-bold">{{ $group->name }}</div>
                            <div class="mx-auto mt-5 mb-5 text-center text-lg">

                                <div class="my-6">

                                    <div class="mb-6 text-center text-lg">{{ $statement->statement }}</div>

                                    <div
                                        class="@if ($statement->scale == 5) grid-cols-5
                                @elseif ($statement->scale = 10) 
                                    grid-cols-10 @endif md:grid md:items-center md:justify-center md:gap-10">

                                        @php $scale_count=1;@endphp

                                        @while ($scale_count <= $statement->scale)
                                            <label
                                                class="md::w-full flex cursor-pointer items-center gap-5 rounded border bg-white px-5 md:block md:h-full md:py-4 md:px-2"
                                                for="group_{{ $group->id }}_statement_{{ $statement->id }}_{{ $scale_count }}">

                                                <div class="flex justify-center">

                                                    <input class="h-5 w-5 md:mb-3"
                                                        id="group_{{ $group->id }}_statement_{{ $statement->id }}_{{ $scale_count }}"
                                                        name="group_{{ $group->id }}_statement_{{ $statement->id }}"
                                                        required type="radio" value="{{ $scale_count }}"
                                                        wire:model="assessment_item.groups.{{ $index }}.statements.{{ $statement_index }}.user_response" />

                                                </div>

                                                <div class="flex h-10 items-center justify-center text-xs">
                                                    {{ $statement->{'scale_' . $scale_count . '_text'} }}

                                                </div>

                                            </label>
                                            @php $scale_count++; @endphp
                                        @endwhile

                                    </div>

                                </div>

                                <hr />

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
                                        id="nextStep" type="submit" wire:click="saveStep()">Continue</button>

                                </div>

                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div>

        @endif

        <input class="hidden" id="next-question" value="{{ (int) $current_question + 1 }}" />

        @push('javascript')
            <script>
                function setupOwl() {
                    $owl = $('.owl-carousel').owlCarousel({
                        items: 1,
                        margin: 15,
                        onDragged: () => {
                            @this.saveStep();
                        }
                    });
                }

                setupOwl();

                Livewire.on('refresh-carousel', () => {
                    console.log('refresh-carousel');
                    $('.owl-carousel').owlCarousel('destroy');
                    $('.owl-carousel').owlCarousel({
                        items: 1,
                        margin: 15,
                        startPosition: $('#next-question').val(),
                        onDragged: () => {
                            @this.saveStep();
                        }
                    });
                })
            </script>
        @endpush

        @if ($is_complete)
            <div>

                <div class="mb-5 text-center text-2xl font-bold">Your Results:</div>

                @foreach ($assessment_item->groups as $group)
                    @php $markings = $response_item->getMarking($group); @endphp
                    @if ($markings)
                        <div class="m-5">

                            <div
                                class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">


                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke-width="1.5"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                @foreach ($markings as $name => $value)
                                    <div class="mt-2 block">
                                        <div class="text-lg font-bold text-gray-700">{{ $group->name }}:
                                            {{ $name }}</div>
                                        <div class="text-md">
                                            @if (is_array($value))
                                                @foreach ($value as $value_row)
                                                    @if (is_array($value_row))
                                                        @foreach ($value_row as $value_subrow)
                                                            <div>{{ $value_subrow }}</div>
                                                        @endforeach
                                                    @else
                                                        <div>{{ $value_row }}</div>
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ $value }}
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    @else
                        <div class="m-5">

                            <div
                                class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">

                                <svg class="mx-auto h-12 w-12 text-gray-400"0 fill="none" stroke-width="1.5"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <span class="font-mediu mt-2 block text-lg font-bold text-gray-400"> We couldn't find a
                                    score at the moment, please check back later </span>

                            </div>

                        </div>
                    @endif
                @endforeach

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
