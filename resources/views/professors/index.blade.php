<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Professores') }}
        </h2>
    </x-slot>
    <div class="py-12 text-sm">
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
                        @foreach ($professors as $professor)
                        <tr class="odd:bg-blue-50">
                            <td class="p-4">{{ $professor->name }}</td>
                            <td class="p-4">{{ $professor->email }}</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('pdfs.professor', $professor->id) }}" method="GET">
                                    @csrf
                                    <x-secondary-button type="submit">{{ __('Ver PEIs') }}</x-secondary-button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>