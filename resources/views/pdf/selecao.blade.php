<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seleção de Professores') }}
        </h2>
    </x-slot>

    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Erro!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="py-12" id="dadosPdf">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-center">Nome do PDF</th>
                        <th class="p-4 text-center">RA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd:bg-blue-50">
                        <td class="p-4 text-center">
                            <a href="{{ route('pdfs.show', $pdf->id) }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ $pdf->original_name }}
                            </a>
                        </td>
                        <td class="p-4 text-center">{{ $pdf->nome_aluno }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="py-12 text-sm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <!-- Formulário de seleção -->
                    <form action="{{ route('enviar-selecionados') }}" method="POST">
                        @csrf
                        <!-- Passando o ID do PDF -->
                        <input type="hidden" name="pdf_id" value="{{ $pdf->id }}">

                        <!-- Tabela de seleção de professores -->
                        <table class="table table-striped table-bordered w-full">
                            <thead>
                            <tr>
                                <th class="p-3 text-center">Selecionar</th>
                                <th class="p-3 text-center">Nome do Professor</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($professors as $professor)
                                <tr>
                                    <td class="p-3 text-center">
                                        <input class="form-check-input form-check-lg" type="checkbox" value="{{ $professor->id }}" id="professor{{ $professor->id }}" name="professores[]" style="transform: scale(1.2);">
                                    </td>
                                    <td class="p-3">{{ $professor->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Botão de envio -->
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                            Enviar Selecionados
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
