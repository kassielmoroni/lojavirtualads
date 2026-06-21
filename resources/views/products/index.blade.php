<x-app-layout>
    <div class="w-full max-w-5xl bg-slate-800 border border-slate-700 p-6 rounded-lg shadow mx-auto mt-8">
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold text-slate-100">Produtos</h1>
            <a href="{{ url('products/new') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">Cadastrar</a>
        </div>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-900 text-green-300 rounded border border-green-700">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-3 bg-red-900 text-red-300 rounded border border-red-700">
            {{ session('error') }}
        </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-slate-600">
                <thead>
                    <tr class="bg-slate-700">
                        <th class="px-4 py-2 text-left text-slate-300 border border-slate-600">Nome</th>
                        <th class="px-4 py-2 text-left text-slate-300 border border-slate-600">Preco</th>
                        <th class="px-4 py-2 text-left text-slate-300 border border-slate-600">Quantidade</th>
                        <th class="px-4 py-2 text-left text-slate-300 border border-slate-600">Tipo</th>
                        <th class="px-4 py-2 text-left text-slate-300 border border-slate-600">Fornecedor</th>
                        <th class="px-4 py-2 text-left text-slate-300 border border-slate-600">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="border-b border-slate-600">
                        <td class="px-4 py-2 text-slate-100">{{ $product->name }}</td>
                        <td class="px-4 py-2 text-amber-400 font-medium">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td class="px-4 py-2 text-slate-100">{{ $product->quantity }}</td>
                        <td class="px-4 py-2 text-slate-100">{{ $product->type->name }}</td>
                        <td class="px-4 py-2 text-slate-100">{{ $product->supplier?->name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <div class="flex justify-center gap-2">
                                <a href="{{ url('/products/update', ['id' => $product->id]) }}" class="bg-slate-600 text-white px-3 py-1 rounded hover:bg-slate-500">Editar</a>
                                <a href="{{ url('/products/delete', ['id' => $product->id]) }}" class="bg-red-700 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-slate-300">Nenhum produto cadastrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
