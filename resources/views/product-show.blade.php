<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <a href="/" class="text-blue-600">← Voltar</a>

    <div class="bg-white p-6 rounded-xl shadow mt-4">

        <img src="{{ asset('storage/' . $product->image) }}"
             class="w-full h-96 object-cover rounded">

        <h1 class="text-2xl font-bold mt-4">
            {{ $product->name }}
        </h1>

        <p class="text-green-600 text-xl font-bold">
            R$ {{ number_format($product->price, 2, ',', '.') }}
        </p>

        <p class="text-gray-600 mt-2">
            Tipo: {{ $product->type->name }}
        </p>

        <p class="mt-4 text-gray-700">
            {{ $product->description }}
        </p>

    </div>

</div>

</body>
</html>