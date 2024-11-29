<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabela dos PEIs') }}
        </h2>
    </x-slot>
    
    <div class="py-12 text-sm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b border-gray-100">
                        <tr>
                            <th class="p-4">Nome do PDF</th>
                            <th class="p-4">Ra</th>
                            <th class="p-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pdfs as $pdf)
                        <tr class="odd:bg-blue-50">
                            <td class="p-4"><a href="{{ route('pdfs.show', $pdf->id) }}" target="_blank" class="text-blue-600 hover:underline">{{ $pdf->original_name }}</a></td>
                            <td class="p-4 text-center"> {{ $pdf->nome_aluno }}</td>
                            <td class="p-4 text-center">
                                <x-secondary-button>{{ __('Compartilhar') }}</x-secondary-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>