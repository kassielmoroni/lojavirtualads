<x-app-layout>

    <form class="w-full max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow" action="{{ url('products/update') }}" method="POST">
        @csrf
        <!-- campo oculto passando o ID como parâmetro no request -->
        <input type="hidden" name="id" value="{{ $product['id'] }}">

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $product['name'])" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Descrição')" />
            <x-text-input id="description" name="description" type="text" class="block mt-1 w-full" :value="old('description', $product['description'])" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="quantity" :value="__('Quantidade')" />
            <x-text-input id="quantity" name="quantity" type="number" class="block mt-1 w-full" :value="old('quantity', $product['quantity'])" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="price" :value="__('Preço')" />
            <x-text-input id="price" name="price" type="number" class="block mt-1 w-full" :value="old('price', $product['price'])" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="type_id" :value="__('Tipo do produto')" />
            <select id="type_id" name="type_id" class="block mt-1 w-full rounded border dark:bg-gray-700 dark:text-white p-2">
                <option value="">Selecione</option>
                @foreach($types as $type)
                <option value="{{ $type->id }}" @selected(old('type_id', $product->type_id) == $type->id)>
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('type_id')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>