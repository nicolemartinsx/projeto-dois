<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6" style="height: 80vh;"> <!-- Definindo uma altura para o contêiner -->
                    <iframe src="{{ url('getpei/' . $nome . '-' . $numero) }}" allowfullscreen style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
                <div class="p-6">
                    <form action="{{ url('confirmar-leitura/'.$file->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="file_id" value="{{ $file->id }}">
                        <div class="form-group mb-4">
                            <input type="checkbox" id="email-recebido" name="email_recebido" required>
                            <label for="email-recebido">Eu confirmo que recebi o e-mail pela coordenação</label>
                        </div>
                        <div class="form-group mb-4">
                            <input type="checkbox" id="leitura-confirmada" name="leitura_confirmada" required>
                            <label for="leitura-confirmada">Eu confirmo que li e estou ciente do PEI</label>
                        </div>
                       
                        <x-secondary-button type="submit">{{ __('Confirmar') }}</x-secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>