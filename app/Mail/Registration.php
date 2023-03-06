<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class Registration extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $verification_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $verification_code)
    {
        //
        $this->name = $name;
        $this->verification_code = $verification_code;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("Support@CityPeople.com", "CityPeople Support"),
            subject: 'CityPeople Registration: Verify Email Address',
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
            view: 'emails.userreg',
            with: ['name' => $this->name, 'verification_code' => $this->verification_code],
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
