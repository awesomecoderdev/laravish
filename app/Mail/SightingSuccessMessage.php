<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SightingSuccessMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $email = "";
    protected $contents = "";
    protected $sighting = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email = "", $contents = "", $sighting = "")
    {
       $this->email=$email;
       $this->contents=$contents;
       $this->sighting=$sighting;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Danke für Ihre Ehrlichkeit!',
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
            view: 'email.sighting-success-message',
            with: ["email" => $this->email, "contents" => $this->contents, "sighting" => $this->sighting]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
