<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servidores') }}
        </h2>
        <a class="bg-indigo-500 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-400 active:bg-indigo-700 focus:bg-indigo-500 transition ease-in-out duration-150" href="{{ route('users.create') }}">Adicionar servidor</a>
    </x-slot>
    <div class="py-12 text-sm" x-data="{ userId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b border-gray-100">
                        <tr>
                            <th class="p-4">Nome</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="odd:bg-blue-50">
                            <td class="p-4">{{ $user->name }}</td>
                            <td class="p-4">{{ $user->email }}</td>
                            <td class="p-4 text-center">
                                <x-danger-button
                                    x-on:click.prevent="userId={{ $user->id }};$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Excluir') }}</x-danger-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-modal name="confirm-user-deletion" focusable>
                    <form method="post" action="{{ route('users.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="userId" x-model="userId" />
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Tem certeza que deseja deletar esse servidor?') }}
                        </h2>
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                            <x-danger-button class="ms-3">
                                {{ __('Excluir') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>