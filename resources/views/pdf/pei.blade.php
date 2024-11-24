<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-6">

                    <div class="p-6">
                    <h4 class="text-md font-semibold">Adicionar PDF</h4>
                    <form action="{{ route('pdf.upload') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                            <div class="mb-4">
                            <label for="pdf" class="block text-sm font-medium text-gray-700">Selecione um arquivo PDF:</label>
                            <input type="file" name="pdf" id="pdf" accept=".pdf" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                             </div>
                           <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                Enviar PDF
                            </button>
                            </div>
                         </form>
                  
                 <!-- MOSTRAR PDFS -->
                 <div class="mt-6">
                    <h4 class="text-md font-semibold text-gray-800">PDFs Enviados</h4>
                    @if(isset($pdfs) && count($pdfs) > 0)
                        <ul class="mt-4 space-y-4">
                            @foreach($pdfs as $pdf)
                                <li class="flex justify-between items-center p-2 border-b border-gray-300">
                                    <!-- Exibe o nome original do arquivo -->
                                    <a href="{{ route('pdfs.show', $pdf->id) }}" target="_blank" class="text-blue-600 hover:underline">{{ $pdf->original_name }}</a>
                                    
                                    <div class="flex items-center space-x-4">
                                        <a href="{{ route('pdfs.download', $pdf->id) }}" class="text-sm text-gray-500 hover:underline">Baixar</a>
                                        <!-- Formulário para deletar o PDF -->
                                        <form action="{{ route('pdfs.deletar', $pdf->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Deletar</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Nenhum PDF enviado ainda.</p>
                    @endif
                </div>
                
             </div>
            </div>
        </div>
    </div>

        
</x-app-layout>