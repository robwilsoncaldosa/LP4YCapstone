<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reviewLink;

    /**
     * Create a new message instance.
     *
     * @param  string  $reviewLink
     * @return void
     */
    public function __construct($reviewLink)
    {
        $this->reviewLink = $reviewLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.review-link')
            ->subject('Write a Review for Your Stay')
            ->with([
                'reviewLink' => $this->reviewLink,
            ]);
    }
}
