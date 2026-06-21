<x-app-layout>
    <form class="w-full max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow" action="{{ url('suppliers/update') }}" method="POST">
        @csrf

        <input type="hidden" name="id" value="{{ $supplier->id }}">

        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Editar Fornecedor</h1>

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $supplier->name)" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email', $supplier->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Telefone')" />
            <x-text-input id="phone" name="phone" type="text" class="block mt-1 w-full" :value="old('phone', $supplier->phone)" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="document" :value="__('Documento')" />
            <x-text-input id="document" name="document" type="text" class="block mt-1 w-full" :value="old('document', $supplier->document)" />
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="city" :value="__('Cidade')" />
            <x-text-input id="city" name="city" type="text" class="block mt-1 w-full" :value="old('city', $supplier->city)" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center gap-3">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
            <a href="{{ url('suppliers') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">Voltar</a>
        </div>
    </form>
</x-app-layout>
