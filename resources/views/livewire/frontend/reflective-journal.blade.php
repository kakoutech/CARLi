<div>

    <nav aria-label="Progress" class="hidden">

        <ol class="flex items-center justify-center" role="list">

            @foreach ($steps as $index => $step)
                <li class="@if ($index + 1 < count($steps)) pr-8 sm:pr-20 @endif relative">

                    @if ($entry->hasCompleted($step))
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
                    @elseif ($current_step == $index + 1)
                        <div aria-hidden="true" class="absolute inset-0 flex items-center" x-description="Current Step">
                            <div class="h-0.5 w-full bg-gray-200"></div>
                        </div>
                        <a aria-current="step"
                            class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 border-brand-600 bg-white"
                            href="#">
                            <span aria-hidden="true" class="h-2.5 w-2.5 rounded-full bg-brand-600"></span>
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

    <div class="mx-5 mt-10 rounded bg-gray-100 py-10 px-5 md:px-10">

        <form wire:submit.prevent="saveStep()">

            @foreach ($steps as $index => $step)
                <div class="@if ($current_step != $index + 1) hidden @endif">

                    <div class="text-center text-2xl font-bold">{{ $step->getTitle() }}</div>

                    <div class="mx-auto mt-5 mb-5 text-center text-lg">

                        {!! $step->getContent() !!}

                    </div>

                </div>
            @endforeach

            <div class="@if ($current_step > count($steps)) hidden @endif">

                <textarea
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm"
                    placeholder="Notes and thoughts..." rows="10" wire:model="step_entry.response"></textarea>

                @error('step_entry.response')
                    <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">Please write your notes and thoughts</div>
                @enderror

            </div>

            <div class="@if (!$show_record) hidden @endif">

                <div class="mt-5 rounded border bg-white p-5" wire:ignore>

                    <h1 class="font-bold">Record Audio</h1>

                    <div class="mb-5 text-center text-2xl font-bold" id="timer">00:00:00</div>

                    <div class="flex justify-center gap-2">

                        <button
                            class="flex items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-red-500 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            id="record" type="button">
                            <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Record
                        </button>
                        <button
                            class="flex items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 opacity-25 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            disabled id="stop" type="button">
                            <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Stop
                        </button>
                    </div>

                    <div class="mt-6">
                        <audio class="hidden w-full" controls id="previewer"></audio>
                    </div>

                    <div class="mt-2 flex hidden justify-center gap-2">
                        <button
                            class="flex items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 opacity-25 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            disabled id="play" type="button">
                            <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 7.5V18M15 7.5V18M3 16.811V8.69c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 010 1.954l-7.108 4.061A1.125 1.125 0 013 16.811z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Play
                        </button>
                        <button
                            class="flex items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 opacity-25 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            disabled id="pause" type="button">
                            <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 7.5V18M15 7.5V18M3 16.811V8.69c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 010 1.954l-7.108 4.061A1.125 1.125 0 013 16.811z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Pause Playback
                        </button>

                    </div>

                </div>

            </div>

            @if ($current_step < count($steps))

                @if ($step_entry->audio || $step_entry->file)

                    <div class="mt-5 rounded border bg-white p-5">

                        <div><b>Response Uploads:</b></div>

                        <div class="p-2">

                            @if ($step_entry->audio)
                                <audio class="w-full" controls id="audio" src="{{ $step_entry->getAudioUrl() }}">

                                    <source id="player" src="{{ $step_entry->getAudioUrl() }}">

                                    Your browser does not support the audio element.

                                </audio>
                            @endif

                        </div>

                        <div class="p-2">
                            @if ($step_entry->file)
                                <a class="text-brand-500" href="{{ $step_entry->getFileUrl() }}">View Uploaded
                                    File</a>
                            @endif
                        </div>

                    </div>

                @endif

            @endif

            <div class="@if ($current_step > count($steps)) hidden @endif pt-5">

                <div class="justify-between md:flex">

                    <div class="flex gap-3">

                        <div
                            class="relative flex cursor-pointer items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            <svg class="h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            @if ($file)
                                {{ $file->getClientOriginalName() }}
                            @else
                                Upload
                            @endif
                            <input class="absolute left-0 top-0 h-full w-full opacity-0" type="file"
                                wire:model="file">
                        </div>

                        <button
                            class="flex items-center gap-2 rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            type="button" wire:click="showRecord()">
                            <svg class="h-5 w-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            Record
                        </button>

                    </div>

                    <div class="mt-3 flex justify-between md:mt-0 md:flex">

                        @if ($current_step > 1)
                            <button
                                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                type="button" wire:click="goBack()">Back</button>
                        @else
                            <div></div>
                        @endif

                        <button
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            id="nextStep" type="submit">Continue</button>

                    </div>

                </div>

            </div>

            @if ($current_step > count($steps))

                <div>

                    <div class="mb-5 text-center text-2xl font-bold">Thank You</div>

                    <div>

                        <p>Your reflective journal entry has been saved.</p>

                        @if ($trainer_responses_sent)

                            <div class="my-5 rounded bg-green-600 p-2 text-white">Your submission has been sent to
                                {{ auth()->user()->trainer->getFullName() }}.</div>

                            <a class="cursor-pointer rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                href="{{ route('dashboard') }}">Dashboard</a>
                        @else
                            <p>Do you want to send any responses to your trainer?</p>

                            <div class="my-5">
                                @foreach ($steps as $step)
                                    @php $response = $entry->getResponse($step); @endphp
                                    <label class="text-md mb-4 flex items-center gap-4"
                                        for="response-checkbox-{{ $step->id }}">
                                        <input class="mr-2 h-6 w-6" id="response-checkbox-{{ $step->id }}"
                                            name="trainer_responses" type="checkbox" value="{{ $response->id }}"
                                            wire:model="trainer_responses.{{ $step->id }}">
                                        {{ $step->title }}
                                    </label>
                                @endforeach
                            </div>

                            @php
                                
                                $show_button = false;
                                foreach ($trainer_responses as $response) {
                                    if ($response) {
                                        $show_button = true;
                                    }
                                }
                                
                            @endphp

                            @if ($show_button)
                                <div class="inline-flex cursor-pointer justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                    wire:click="sendToTrainer()">Send Responses</div>
                            @else
                                <button
                                    class="inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white opacity-50 shadow-sm hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                    disabled type="button">Send Responses</button>
                            @endif

                        @endif

                    </div>

                </div>

            @endif

            <div wire:ignore>

                <script>
                    var elapsed_time = 0;
                    var is_recording = false;

                    function toHoursAndMinutes(totalSeconds) {
                        const totalMinutes = Math.floor(totalSeconds / 60);

                        const seconds = totalSeconds % 60;
                        const hours = Math.floor(totalMinutes / 60);
                        const minutes = totalMinutes % 60;

                        return hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString()
                            .padStart(2, '0');
                    }

                    const recordAudio = () => new Promise(async resolve => {
                        const stream = await navigator.mediaDevices.getUserMedia({
                            audio: true
                        });
                        const mediaRecorder = new MediaRecorder(stream, {
                            mimeType: 'audio/webm'
                        });
                        let audioChunks = [];

                        mediaRecorder.addEventListener('dataavailable', event => {
                            audioChunks.push(event.data);
                        });

                        const start = () => {
                            is_recording = true;
                            audioChunks = [];
                            mediaRecorder.start();
                        };

                        setInterval(() => {
                            if (is_recording) {
                                elapsed_time += 1000;
                            }

                            document.querySelector('#timer').innerHTML = toHoursAndMinutes(elapsed_time / 1000);
                        }, 1000);

                        const stop = () =>
                            new Promise(resolve => {
                                mediaRecorder.addEventListener('stop', () => {
                                    const audioBlob = new Blob(audioChunks, {
                                        type: 'audio/mpeg'
                                    });
                                    const audioUrl = URL.createObjectURL(audioBlob);
                                    document.querySelector('#previewer').setAttribute('src', audioUrl);
                                    const audio = new Audio(audioUrl);
                                    const play = () => audio.play();
                                    const pause = () => audio.pause();
                                    resolve({
                                        audioChunks,
                                        audioBlob,
                                        audioUrl,
                                        play,
                                        pause
                                    });
                                });

                                is_recording = false;
                                mediaRecorder.stop();
                            });

                        resolve({
                            start,
                            stop
                        });
                    });

                    const sleep = time => new Promise(resolve => setTimeout(resolve, time));

                    const recordButton = document.querySelector('#record');
                    const stopButton = document.querySelector('#stop');
                    const playButton = document.querySelector('#play');
                    const pauseButton = document.querySelector('#pause');
                    const previewer = document.querySelector('#previewer');

                    let recorder;
                    let audio;

                    recordButton.addEventListener('click', async () => {
                        recordButton.setAttribute('disabled', true);
                        stopButton.removeAttribute('disabled');
                        playButton.setAttribute('disabled', true);
                        pauseButton.setAttribute('disabled', true);

                        recordButton.classList.add('opacity-25');
                        stopButton.classList.remove('opacity-25');
                        playButton.classList.add('opacity-25');
                        pauseButton.classList.add('opacity-25');
                        if (!recorder) {
                            recorder = await recordAudio();
                        }
                        recorder.start();
                    });

                    stopButton.addEventListener('click', async () => {
                        recordButton.removeAttribute('disabled');
                        stopButton.setAttribute('disabled', true);
                        playButton.removeAttribute('disabled');
                        pauseButton.setAttribute('disabled', true);

                        recordButton.classList.remove('opacity-25');
                        stopButton.classList.add('opacity-25');
                        playButton.classList.remove('opacity-25');
                        pauseButton.classList.add('opacity-25');

                        previewer.classList.remove('hidden');

                        audio = await recorder.stop();
                        saveAudio();
                    });

                    playButton.addEventListener('click', () => {
                        elapsed_time = 0;
                        is_playing = true;
                        recordButton.setAttribute('disabled', true);
                        stopButton.setAttribute('disabled', true);
                        playButton.setAttribute('disabled', true);
                        pauseButton.removeAttribute('disabled');

                        recordButton.classList.add('opacity-25');
                        stopButton.classList.add('opacity-25');
                        playButton.classList.add('opacity-25');
                        pauseButton.classList.remove('opacity-25');

                        audio.play();
                    });

                    pauseButton.addEventListener('click', () => {
                        is_playing = false;
                        console.log(audio.duration);
                        recordButton.removeAttribute('disabled');
                        stopButton.setAttribute('disabled', true);
                        playButton.removeAttribute('disabled');
                        pauseButton.setAttribute('disabled', true);

                        recordButton.classList.add('opacity-25');
                        stopButton.classList.add('opacity-25');
                        playButton.classList.remove('opacity-25');
                        pauseButton.classList.add('opacity-25');

                        audio.pause();
                    });

                    function saveAudio() {
                        const reader = new FileReader();
                        reader.readAsDataURL(audio.audioBlob);
                        reader.onload = () => {
                            const base64AudioMessage = reader.result.split(',')[1];
                            @this.set('audio', base64AudioMessage);
                        };
                    }

                    document.querySelector('#nextStep').addEventListener('click', () => {
                        stopButton.click();
                        elapsed_time = 0;
                        document.querySelector('#timer').innerHTML = toHoursAndMinutes(elapsed_time / 1000);
                    });
                </script>

            </div>

        </form>

    </div>

</div>
