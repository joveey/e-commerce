<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verse Beauty') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
            <!-- Brand -->
            <div class="text-center mb-6">
                <a href="/" class="text-3xl font-bold text-pink-500 hover:text-pink-600 transition">Verse Beauty</a>
                <p class="text-sm text-gray-500 mt-2">Masuk ke akunmu untuk mulai belanja</p>
            </div>

            <!-- Auth Form Slot -->
            {{ $slot }}
        </div>
    </div>
</body>
</html>
