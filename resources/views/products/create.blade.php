<x-app-layout>

    <form class="w-full max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow" action="{{ url('products/new') }}" method="POST">
        @csrf

        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Cadastrar Produto</h1>

        @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif

        <label class="block mb-1 text-gray-700 dark:text-gray-300">Nome:</label>
        <input class="w-full p-2 mb-4 rounded border dark:bg-gray-700 dark:text-white" required name="name" type="text" />
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Descrição:</label>
        <input class="w-full p-2 mb-4 rounded border dark:bg-gray-700 dark:text-white" name="description" type="textarea" />
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Quantidade:</label>
        <input class="w-full p-2 mb-4 rounded border dark:bg-gray-700 dark:text-white" name="quantity" type="number" />
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Preço:</label>
        <input class="w-full p-2 mb-4 rounded border dark:bg-gray-700 dark:text-white" name="price" type="number" />

        <label class="block mb-1 text-gray-700 dark:text-gray-300">Tipo do produto:</label>

        <select class="w-full p-2 mb-4 rounded border dark:bg-gray-700 dark:text-white" name="type_id">
            <option value="">Selecione</option>

            @foreach($types as $type)
            <option value="{{ $type->id }}">
                {{ $type->name }}
            </option>
            @endforeach

        </select>

        <input class="w-full p-2 rounded bg-blue-600 text-white" type="submit" value="Salvar" />
    </form>

</x-app-layout>