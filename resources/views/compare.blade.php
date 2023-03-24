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
            <form action="{{ route('compare') }}" method="POST" class="w-2/5">
                @csrf
                <input type="hidden" name="dish" value="{{ $dish }}" />
                <div class="flex items-center gap-2 mb-4">
                    <p>{{ $dish }} é </p>
                    <input type="text" name="category" class="py-2 px-1 border-gray-500 border-2 rounded-lg w-64" required/>
                    <p> mas {{ $currentDish }} não.</p>
                </div>
                <button href="{{ route('question') }}" class="w-full py-2 px-4 bg-green-600 hover:bg-green-800 text-white rounded-md mt-2 text-center">Enviar</button>
            </form>
        </div>
    </body>
</html>
