<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <title>{{ $title ?? 'Daraz Lite' }}</title>
</head>

<body class="bg-slate-200" >
@livewire('partials.header')
<main>

    {{ $slot }}
    </main>

    @livewire('partials.footer')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

</body>

</html>
