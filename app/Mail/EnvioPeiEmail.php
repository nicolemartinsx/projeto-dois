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
}
