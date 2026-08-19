<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-900 text-black dark:text-white antialiased">
    <div x-data="{ sideBar: true }" class="flex h-screen overflow-hidden">

        @include('layouts.navigation')


        <main
            class="flex-1 overflow-x-hidden overflow-y-auto m-2 custom-scrollbar rounded-lg shadow-lg bg-[#F4F4F4] dark:bg-gray-700 text-black dark:text-white">

            @isset($header)
                <header class="bg-white dark:bg-gray-700 shadow p-4 flex items-center justify-between">
                    <h2 class="font-semibold text-xl leading-tight flex items-center gap-2 text-gray-800 dark:text-white">
                        <button @click="sideBar = !sideBar" type="button">
                            <x-icon name="sidebar" class="w-6 h-6" ::class="{ 'rotate-180': sideBar }" />
                        </button>
                        {{ $header }}
                    </h2>

                    {{-- Show button only if route or action is set --}}
                    @isset($buttonAction)
                        <x-primary-button @click="{{ $buttonAction }}">
                            <x-icon name="plus" class="w-4 h-4" />
                            {{ $buttonLabel ?? 'New' }}
                        </x-primary-button>
                    @elseif (isset($buttonRoute))
                        <x-primary-button :href="$buttonRoute">
                            <x-icon name="plus" class="w-4 h-4" />
                            {{ $buttonLabel ?? 'New' }}
                        </x-primary-button>
                    @endisset
                </header>
            @endisset




            <main class="flex-1">
                {{ $slot }}
            </main>
        </main>

    </div>
</body>

</html>
