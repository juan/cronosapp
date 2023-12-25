<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    @if ($title)
        <title>{{ $title }} - Cronos</title>
    @else
        <title>Cronos</title>
    @endif

    <!-- Generics -->
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon-32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon-128.png') }}" sizes="128x128">
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon-192.png') }}" sizes="192x192">

    <!-- Android -->
    <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon/favicon-196.png') }}" sizes="196x196">

    <!-- iOS -->
    <link rel="apple-touch-icon" href="{{ Vite::asset('resources/images/favicon/favicon-152.png') }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ Vite::asset('resources/images/favicon/favicon-167.png') }}" sizes="167x167">
    <link rel="apple-touch-icon" href="{{ Vite::asset('resources/images/favicon/favicon-180.png') }}" sizes="180x180">

    {{-- <link rel="stylesheet" href="{{ asset('build/css/style.css') }}" /> --}}
    @vite([ 'resources/css/style.css'])
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" href="{{ Vite::asset('node_modules/sweetalert2/dist/sweetalert2.css') }}">
</head>