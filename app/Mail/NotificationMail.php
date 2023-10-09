<?php

namespace App\Mail;

use App\Models\Sighting;
use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $tag, $sighting;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tag $theTag, Sighting $theSighting)
    {
        $this->tag=$theTag;
        $this->sighting=$theSighting;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = "Hurra, gefunden!";

        if(config("mail.support_email_enabled")){
            return new Envelope(
                from: new Address(config("mail.support_email"), 'Support'),
                subject: $subject,
            );
        }else{
            return new Envelope(
                subject: $subject,
            );
        }

    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        return new Content(
            view: 'email.foundNotification',
            with: array("tag"=>$this->tag, "sighting"=>$this->sighting)
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
