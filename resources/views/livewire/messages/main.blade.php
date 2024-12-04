<div class="-m-10 min-h-screen text-gray-800 antialiased md:flex">

    <div class="bg-gray-100 md:h-auto md:w-1/4">

        <div class="flex w-full flex-col md:h-full">

            <div class="flex flex-row items-center justify-between bg-white py-4 px-6 shadow" style="height: 72px;">

                <div class="text-lg font-semibold">Conversations</div>

                <button
                    class="toggle-new-conversation-modal flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300"
                    target="_blank">
                    <span>
                        <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>
                </button>

            </div>

            <div class="p-4">

                <div class="flex h-64 flex-col overflow-y-scroll md:overflow-visible">

                    @if ($conversations && $conversations->count())

                        @foreach ($conversations as $conversation)
                            @if ($conversation->user)
                                @php $unread_message_count = $conversation->getUnreadMessageCount(); @endphp

                                <div class="@if ($current_conversation && $current_conversation->id == $conversation->id) bg-brand-500  text-white
                                    @elseif ($unread_message_count) bg-red-50 
                                    @else bg-white @endif relative mb-2 flex cursor-pointer flex-row items-center rounded p-4 shadow"
                                    wire:click="loadConversation('{{ $conversation->id }}')">

                                    <div
                                        class="@if ($current_conversation && $current_conversation->id == $conversation->id) text-white @else text-gray-500 @endif absolute right-0 top-0 mr-4 mt-3 text-xs">

                                        {{ $conversation->getLastMessageTime() }}

                                    </div>

                                    <div class="flex flex-shrink-0 items-center justify-center">

                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ $conversation->user->getAvatar() }}" />

                                    </div>

                                    <div class="ml-3 flex flex-grow flex-col">

                                        <div
                                            class="@if ($current_conversation && $current_conversation->id == $conversation->id) text-white @else text-gray-900 @endif text-sm font-medium">
                                            {{ $conversation->user->getFullName() }}</div>

                                        <div class="w-40 truncate text-xs">{{ $conversation->getLastMessagePreview() }}
                                        </div>

                                    </div>

                                    <div class="ml-2 mb-1 flex-shrink-0 self-end">

                                        @if ($unread_message_count)
                                            <span
                                                class="flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">

                                                {{ $unread_message_count }}

                                            </span>
                                        @endif

                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="bg-white bg-opacity-20 p-5 text-center text-white">No Conversations Found.</div>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <div class="bg-gray-200 md:w-3/4">

        @if ($current_conversation)
            <div class="flex flex-row items-center bg-white py-4 px-6 shadow">

                <div class="flex items-center justify-center">

                    <img class="h-10 w-10 rounded-full" src="{{ $current_conversation->user->getAvatar() }}">

                </div>

                <div class="ml-3 flex flex-col">

                    <div class="text-lg font-semibold">{{ $current_conversation->user->getFullName() }}</div>

                </div>

            </div>
        @else
            <div class="flex flex-row items-center bg-white py-4 px-6 shadow">

                <div class="flex items-center justify-center">

                    <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->getAvatar() }}">

                </div>

                <div class="ml-3 flex flex-col">

                    <div class="text-lg font-semibold">Messages</div>

                </div>

            </div>
        @endif

        <div>

            @if ($current_conversation)

                <div class="m-10 grid-cols-12 gap-y-2 md:grid">

                    @foreach ($current_conversation->messages as $message)
                        @if ($message->isMine())
                            <div class="col-end-8 rounded-lg p-3 md:col-start-1">

                                <div class="flex flex-row items-center">

                                    <div class="flex flex-shrink-0 items-center justify-center">

                                        <img class="h-12 w-12 rounded-full" src="{{ $message->user->getAvatar() }}" />

                                    </div>

                                    <div class="relative ml-3 rounded-xl bg-white py-2 px-4 shadow">

                                        <div>{{ $message->getMessageContent() }}</div>

                                    </div>

                                </div>

                                <div class="mt-1 pl-16 text-left text-sm text-gray-500">
                                    {{ $message->created_at->diffForHumans() }}</div>

                            </div>
                        @else
                            <div class="col-end-13 rounded-lg p-3 md:col-start-6">

                                <div class="flex flex-row-reverse items-center justify-start">

                                    <div class="flex flex-shrink-0 items-center justify-center">

                                        <img class="h-12 w-12 rounded-full" src="{{ $message->user->getAvatar() }}" />

                                    </div>

                                    <div class="relative mr-3 rounded-xl bg-indigo-100 py-2 px-4 shadow">

                                        <div>{{ $message->getMessageContent() }}</div>

                                    </div>

                                </div>

                                <div class="mt-1 pr-16 text-right text-sm text-gray-500">
                                    {{ $message->created_at->diffForHumans() }}</div>

                            </div>
                        @endif
                    @endforeach

                </div>
            @else
                <div class="p-4">

                    <div
                        class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 bg-white p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">

                        <svg class="feather feather-users mx-auto h-24 w-24 text-gray-400" fill="none" height="24"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                            viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>

                        <span class="mt-10 block text-lg font-medium text-gray-900"> Please select a conversation on the
                            the left to load your messages. </span>

                        <button
                            class="toggle-new-conversation-modal mt-10 inline-flex items-center rounded-md border border-transparent bg-brand-600 px-6 py-4 text-lg font-medium text-white shadow-sm hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                            type="button">
                            <svg aria-hidden="true" class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    fill-rule="evenodd" />
                            </svg>
                            Start a New Conversation
                        </button>

                    </div>

                </div>

            @endif

        </div>

        @if ($current_conversation)
            <hr class="my-5" />

            <div class="px-10 pb-10">

                <form class="flex flex-row items-center" wire:submit.prevent="sendMessage">

                    <div class="w-full">

                        <textarea
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm"
                            placeholder="Type your message...." rows="5" wire:model="message"></textarea>

                        @error('message')
                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }} </div>
                        @enderror

                    </div>

                    <div class="m-6">

                        <button
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-500 text-brand-800 text-white hover:bg-brand-600"
                            type="submit">

                            <svg class="-mr-px h-5 w-5 rotate-90 transform" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"></path>
                            </svg>

                        </button>

                    </div>

                </form>

            </div>
        @endif

    </div>

    <div class="fixed top-0 left-0 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-20"
        id="new-conversation" style="z-index:99;" wire:ignore.self>

        <div class="w-full max-w-lg rounded-lg bg-white shadow-lg">

            <div class="mt-5 border-b pb-5 text-center text-xl text-brand-500">

                New Conversation

            </div>

            <div class="p-5">

                <form class="space-y-8 divide-y divide-gray-200" wire:submit.prevent="newConversation">

                    <div class="space-y-8 divide-y divide-gray-200">

                        <div>

                            <div>

                                <h3 class="text-lg font-medium leading-6 text-gray-900">New Conversation</h3>

                                <p class="mt-1 text-sm text-gray-500">Choose a user to start a conversation with.</p>

                            </div>

                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                <div class="sm:col-span-6">

                                    <div class="">

                                        <select
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm"
                                            id="user_id" name="user_id" wire:model="user_id">

                                            <option value="">-- Choose User --</option>

                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->getFullName() }}
                                                </option>
                                            @endforeach

                                        </select>

                                        @error('user_id')
                                            <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                                <div class="sm:col-span-6">

                                    <textarea
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm"
                                        placeholder="Type your message...." rows="5" wire:model="message"></textarea>

                                    @error('message')
                                        <div class="mt-1 rounded bg-red-500 py-2 px-4 text-white">{{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="pt-5">

                        <div class="flex justify-end">

                            <button
                                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-brand-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                type="submit">Start Conversation</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        var btns = document.querySelectorAll('.toggle-new-conversation-modal');

        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector('#new-conversation').classList.toggle('hidden');
            });
        }
    </script>

</div>
