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
                <a href="/" class="py-2 px-4 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md mt-2">Reiniciar</a>
            </div>
            @if ( $ask === true )
                <form action="{{ route('add-dish') }}" method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <p>Qual prato você pensou?</p>
                        <input type="text" name="dish" class="py-2 px-1 border-gray-500 border-2 rounded-lg w-64" required/>
                        <button  class="py-2 px-4 bg-green-600 hover:bg-green-800 text-white rounded-md mt-2 text-center">Enviar</button>
                    </div>
                </form>
            @else
                <div class="flex items-center flex-col">
                    <p class="text-lg font-bold text-gray-700">{{ $response }}</p>
                </div>
            @endif
        </div>
    </body>
</html>
