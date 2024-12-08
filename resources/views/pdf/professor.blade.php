<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            PEIs enviados ao professor(a) {{ $professor->name }}
        </h2>
    </x-slot>
    <div class="py-12 text-sm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($pdfs) > 0)
                <table class="w-full">
                    <thead class="border-b border-gray-100">
                        <tr>
                            <th class="p-4">ARQUIVO</th>
                            <th class="p-4">RA</th>
                            <th class="p-4">VISUALIZADO</th>
                            <th class="p-4">CONFIRMADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pdfs as $pdf)
                        <tr class="odd:bg-blue-50">
                            <td class="p-4">{{ $pdf->original_name }}</td>
                            <td class="p-4 text-center"> {{ $pdf->nome_aluno }}</td>
                            <td class="p-4 text-center">
                                @if ($pdf->visualizado)
                                Sim
                                @else
                                Não
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if ($pdf->confirmado)
                                Sim
                                @else
                                Não
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="p-8 text-base text-gray-500">Nenhum PDF enviado ainda.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>