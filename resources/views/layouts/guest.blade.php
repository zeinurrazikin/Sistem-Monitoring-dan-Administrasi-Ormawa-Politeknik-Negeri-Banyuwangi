<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - ORMAWA System</title>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body bg-surface-container-high text-on-surface min-h-screen relative flex items-center justify-center p-4">
        <div class="fixed inset-0 z-0">
            <img src="{{ asset('images/IMG_9667-scaled-1.jpg') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"></div>
        </div>

        <main class="relative z-10 w-full max-w-[460px]">
            {{ $slot }}
        </main>
    </body>
</html>