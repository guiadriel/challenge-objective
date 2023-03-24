<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased">
        <div class="h-100 w-100 p-2 flex items-center flex-col">
            <div class="flex items-center gap-4 mb-24">
                <h1 class=" text-2xl font-bold">Jogo Gourmet</h1>
                <a href="{{ route('clean') }}" class="py-2 px-4 bg-gray-500 hover:bg-gray-700 text-white rounded-md mt-2">Zerar aprendizado</a>
            </div>
            <div class="flex items-center flex-col">
                <p class="text-lg font-bold text-gray-700">Pense em um prato que gosta</p>
                <a href="{{ route('play') }}" class="py-2 px-4 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md mt-2">Começar</a>
            </div>
        </div>
    </body>
</html>
