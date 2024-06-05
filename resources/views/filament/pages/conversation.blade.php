<x-filament::page>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="utf-8">
        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }

            .unread-dot {
                width: 15px;
                height: 15px;
                background-color: rgb(72, 244, 72);
                border-radius: 50%;
                display: inline-block;
                margin-left: 5px;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const messageList = document.getElementById('message-list');
                if (messageList) {
                    messageList.scrollTop = messageList.scrollHeight;
                }

                Livewire.hook('message.processed', (message, component) => {
                    const messageList = document.getElementById('message-list');
                    if (messageList) {
                        messageList.scrollTop = messageList.scrollHeight;
                    }
                });
            });
        </script>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <div class="relative h-screen md:h-[35rem] grid 0 md:grid-cols-3 gap-4 ">
        <!-- Users Section -->

        <div
            class="w-full flex md:block md:h-[35rem] bg-gray-800 rounded-3xl text-white text-lg px-2 md:p-5 font-semibold @if (count($allUsers) === 0) md:hidden @endif">
            <div class="hidden md:block">All Users</div>
            <div class="flex overflow-y-scroll md:block">
                @foreach ($allUsers as $chatUser)
                    <div wire:click="selectUser({{ $chatUser->id }})"
                        class="mx-2 md:mx-0 p-1 md:p-5 my-2 text-lg font-normal bg-gray-400 cursor-pointer rounded-xl hover:bg-gray-600
                         {{ $chatUser->id === $receiver_id ? 'border-4 border-orange-500' : '' }}">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full"
                                src="https://avatar-management--avatars.us-west-2.prod.public.atl-paas.net/default-avatar.png" />
                            <div class="flex items-center justify-between w-full">
                                <div class="mx-5">
                                    {{ $chatUser->name }}
                                    <div class="text-sm text-orange-400">{{ $chatUser->email }}</div>
                                </div>
                                @if ($this->hasUnreadMessages($chatUser->id))
                                    <div class="unread-dot"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Messages Section -->
        <div
            class="w-full md:h-[35rem]  overflow-y-scroll col-span-2 @if (count($allUsers) === 0) col-span-3 @endif">
            <!-- Message List -->
            <div id="message-list" class="flex-1 mb-20 space-y-2 overflow-y-auto md:p-4 md:mb-14">
                @foreach ($messages as $message)
                    <div
                        class="flex md:w-full w-[75%] @if ($message->sender_id === Auth::id()) justify-end @else justify-start @endif">
                        <div
                            class="p-4 rounded-2xl max-w-xs @if ($message->sender_id === Auth::id()) bg-orange-200 @else bg-orange-500 @endif">
                            <div
                                class="font-bold underline @if ($message->sender_id === Auth::id()) text-orange-500 @else text-white @endif">
                                @if ($message->sender_id === Auth::id())
                                    Me
                                @else
                                    {{ optional($message->sender)->name ?? 'Unknown Sender' }}
                                @endif
                            </div>
                            <div class="@if ($message->sender_id === Auth::id()) text-orange-500 @else text-white @endif">
                                {{ $message->message }}
                            </div>
                            <div
                                class="text-xs border-t mt-2 @if ($message->sender_id === Auth::id()) text-orange-500 @else text-white @endif">
                                @if ($message->isRead)
                                    <i class="fa fa-check done-icon"></i>
                                @endif
                                {{ $message->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Input Form -->

        </div>
        <div class="absolute bottom-0 right-0 flex items-center w-[100%] md:w-[65%] p-4 bg-gray-800 rounded-xl">
            <input type="text" wire:model="sendingMessage" placeholder="Type your message here..."
                class="flex-1 p-2 text-orange-500 bg-gray-200 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            <x-filament::button wire:click="sendMessage" type="submit">
                Send
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
