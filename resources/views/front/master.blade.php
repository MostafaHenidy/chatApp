<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Chat App') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('front-assets/styles.css') }}">
</head>

<body>
    <div id="app">
        <div class="chat-container">
            @include('front.aside')
            @yield('content')
        </div>
    </div>
    @livewireScripts
</body>

</html>
