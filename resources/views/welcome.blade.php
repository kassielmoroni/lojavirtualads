<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<header class="bg-white shadow">
    <div class="container mx-auto p-6 flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                🛒 Loja Virtual
            </h1>
            <p class="text-gray-500">
                Veja nossos produtos disponíveis
            </p>
        </div>

        <div class="flex gap-3">

            @auth
                <a href="{{ route('dashboard') }}"
                   class="bg-gray-800 text-white px-4 py-2 rounded-lg">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded-lg">
                    Register
                </a>
            @endauth

        </div>

    </div>
</header>

<!-- CONTEÚDO -->
<div class="container mx-auto p-6">

    <!-- FILTRO -->
    <form method="GET" action="/" class="flex gap-3 mb-8">

        <select name="type"
            class="w-64 border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200">

            <option value="">Todos os tipos</option>

            @foreach($types as $type)
                <option value="{{ $type->id }}"
                    {{ request('type') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach

        </select>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
            Filtrar
        </button>

    </form>

    <!-- GRID DE PRODUTOS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($products as $product)

            <a href="{{ route('product.show', $product->id) }}"
               class="block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                <!-- IMAGEM SEM CORTAR -->
                @if($product->image)
                    <div class="h-56 bg-white flex items-center justify-center p-2">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="max-h-full max-w-full object-contain hover:scale-105 transition">
                    </div>
                @else
                    <div class="h-56 bg-gray-200 flex items-center justify-center text-gray-400">
                        Sem imagem
                    </div>
                @endif

                <!-- INFO -->
                <div class="p-4">

                    <h2 class="text-lg font-bold text-gray-800">
                        {{ $product->name }}
                    </h2>

                    <p class="text-green-600 font-bold text-lg mt-1">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $product->type->name ?? 'Sem tipo' }}
                    </p>

                </div>

            </a>

        @empty

            <p class="text-gray-500">Nenhum produto encontrado.</p>

        @endforelse

    </div>

</div>

</body>
</html>