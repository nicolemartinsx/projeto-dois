<?php

namespace App\Mail;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnvioPeiEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct($dados)
    {
        // Atribuindo os dados para as variáveis
        $this->nome = $dados['nome'];
        $this->pdf = $dados['pdf'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo PEI Recebido - ' . $this->pdf->nome_aluno,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Recupera o caminho do arquivo a partir do modelo File
        $filePath = storage_path('app/private/' . $this->pdf->file_path); // Adapte o caminho conforme necessário

        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($filePath)->as($this->pdf->original_name), // Envia o arquivo com o nome original
        ];
    }
}
