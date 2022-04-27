<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewApartmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $newContactMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_newContactMessage)
    {
        $this->newContactMessage = $_newContactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New message from ' . $this->newContactMessage->name . ' ' . $this->newContactMessage->lastname)->view('mails.newMessage');
    }
}
