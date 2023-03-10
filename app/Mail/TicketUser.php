<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class TicketUser extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $name)
    {
        $this->pdf = $pdf;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('contato@kanastra.com', 'John Suport'),
            subject: 'Boleto da sua dívida ativa',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.tickets',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromData(fn () => $this->pdf, 'boleto.html')
                ->withMime('text/html'),
        ];
    }
}
