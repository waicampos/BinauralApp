<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TLCEMail extends Mailable
{

    
    use Queueable, SerializesModels;


    public $folder;
    public $file;


    /**
     * Create a new message instance.
     */
    public function __construct($docName)
    {
        //$this->folder = storage_path('app').$path;
        $this->file = $docName;
        //dd($this->folder.$this->file);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Termo de Livre Consentimento Esclarecido',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.tlce',
            //text: 'mail.tlce-text'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->file),
        ];
    }
}
