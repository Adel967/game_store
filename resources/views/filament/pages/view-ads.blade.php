<x-filament-panels::page>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="utf-8">
        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <!-- Ads Modal -->
    <div
        class="z-40 group absolute w-[70%] h-[75%] rounded-xl bg-gradient-to-r from-orange-500 to-yellow-600-500 overflow-hidden -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 {{ $showModal ? '' : 'hidden' }}">
        <div class="absolute z-20 w-full h-full duration-700 -translate-x-1/2 -translate-y-1/2 cursor-pointer rounded-xl group-hover:scale-110 top-1/2 left-1/2"
            style="background-image: url('{{ Storage::url($firstAdImage) }}'); background-size: cover; background-position: center;">
        </div>
        <!-- layar -->
        

        <!-- Exit Button -->
        <div class="flex justify-end p-4">
            <x-filament::button wire:click="hideModal" class="z-50">
                Close
            </x-filament::button>
        </div>

     


        <div class="z-40 relative flex flex-col items-center justify-center h-full">
        <div class="absolute  w-full h-screen -translate-y-20  bg-black/20 "></div>
            <!-- Previous Button -->
            <button wire:click="previousAd"
                class="absolute z-30 p-4 text-2xl text-white transform -translate-y-1/2 left-4 top-1/3 hover:cursor-pointer">
                <i class="fa fa-arrow-left"></i>
            </button>

            <!-- Ad Content -->
            <div class="z-50 flex flex-col items-center justify-center flex-1 ">
                @if ($firstAdLink)
                    <a href="{{ $firstAdLink }}" target="_blank" class="absolute mb-4 bottom-1/4">
                        <x-filament::button>
                            Go to Ad
                        </x-filament::button>
                    </a>
                @else
                    <p class="text-white">No ad available.</p>
                @endif
            </div>

            <!-- description -->

            <div class="absolute flex flex-col items-center top-1/4 left-1/2  -translate-x-1/2 translate-y-full ">
                <h1 class="text-3xl font-bold pb-3">
                {{$firstAdTitle}}</h1>

                {{$firstAdDesc}}
                <br/>
            </div>

            <!-- Next Button -->
            <button wire:click="nextAd"
                class="absolute z-50  p-4 text-2xl text-white transform -translate-y-1/2 right-4 top-1/3 hover:cursor-pointer">
                <i class="fa fa-arrow-right"></i>
            </button>

        </div>

    </div>

    <!-- Centered Label -->
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="flex flex-col items-center">
            <p class="text-3xl font-bold">Welcome to our Store</p>
            <x-filament::button wire:click="showModalFunction" class="mt-4 cursor-pointer">
                Show Ads
            </x-filament::button>
        </div>
    </div>
</x-filament-panels::page>
