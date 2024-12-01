<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabela dos PEIs') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    <div class="py-12 text-sm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b border-gray-100">
                        <tr>
                            <th class="p-4">ARQUIVO</th>
                            <th class="p-4">RA</th>
                            <th class="p-4">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pdfs as $pdf)
                        <tr class="odd:bg-blue-50">
                            <td class="p-4"><a href="{{ route('pdfs.show', $pdf->id) }}" target="_blank" class="text-blue-600 hover:underline text-center">{{ $pdf->original_name }}</a></td>
                            <td class="p-4 text-center"> {{ $pdf->nome_aluno }}</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('pdfs.selecao', $pdf->id) }}" method="GET">
                                    @csrf
                                    <x-secondary-button type="submit">{{ __('Compartilhar') }}</x-secondary-button>
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