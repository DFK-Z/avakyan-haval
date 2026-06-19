<!DOCTYPE html>
<html class="light" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Haval Volgograd — Управляй своей мечтой')</title>
    <meta name="description" content="@yield('meta_description', 'Официальный дилер Haval в Волгограде. Автопарк, кредит, тест-драйв, сервис.')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-background text-on-background text-body-md antialiased selection:bg-primary selection:text-on-primary">
    <x-layout.nav />

    <main class="pt-20">
        {{ $slot }}
    </main>

    <x-layout.footer />

    @livewireScripts
</body>
</html>
