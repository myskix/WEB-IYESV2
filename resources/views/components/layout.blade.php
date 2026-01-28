<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{ $meta ?? '' }}

    <title>{{ $title ?? 'IYES INDONESIA' }}</title>

    <link rel="icon" href="{{ asset('images/logo-iyes.svg') }}" type="image/svg+xml">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Fonts: Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-gray-50 text-slate-800 antialiased flex flex-col min-h-screen font-montserrat">

    <x-navbar />

    <main class="flex-grow pt-20"> {{-- pt-20 untuk kompensasi fixed navbar --}}
        {{ $slot }}
    </main>
    
    <x-footer />
    
    @livewireScripts
</body>

</html>