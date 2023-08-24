<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $validatedData;

    /**
     * Create a new message instance.
     *
     * @param array $requestData The form data
     */
    public function __construct(array $validatedData)
    {
        $this->validatedData = $validatedData;
    }

         /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Waiting for Approval',
        );

    }

    /**
     * Get the message content definition.
     */


     public function content(): Content
    {
        return new Content(
            view: 'emails.contact',

        );
    }



    /**
     * Get the attachments for the message.
     *
     * @return array

     */
    public function attachments(): array
    {
        return [];
    }

}

