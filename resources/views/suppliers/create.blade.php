<x-app-layout>

    <form>

        <x-toast type="success" message="Operação realizada com sucesso!" />

        <x-toast type="error" message="Erro ao salvar os dados." />

        <x-toast type="warning" message="Atenção: revise as informações." />

        <x-input-label for="name" :value="'Nome do fornecedor'" />

        <x-text-input id="name" class="block mt-1 w-full"
            type="text" name="name" :value="old('name')"
            required autofocus />

        <x-primary-button class="mt-4">
            Salvar
        </x-primary-button>
    </form>
</x-app-layout>