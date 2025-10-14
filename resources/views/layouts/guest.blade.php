<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="font-sans antialiased text-white" 
          style="background-image: url('{{ asset('images/header-image.png') }}'); 
                 background-size: cover; 
                 background-position: center; 
                 background-attachment: fixed;">
        
        <div class="absolute inset-0 bg-black opacity-60"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="w-60 h-20 fill-current text-red-600" />
                </a>
            </div>

             <h2 class="text-xl font-bold text-white mt-4 mb-8 tracking-wider">
        Las Mejores Peliculas y Series En Un Solo Lugar
    </h2>

          <div class="w-full sm:max-w-md mt-6 px-12 py-10 
            text-white shadow-2xl overflow-hidden sm:rounded-lg"
            
            style="background-color: rgba(24, 24, 24, 0.7);">
    {{ $slot }}
</div>
        </div>
    </body>
</html>