<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LupaPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email, $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $type)
    {
        $this->email = $email;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Pengaturan Ulang Password')
            ->from(config('mail.from'))
            ->to($this->email)
            ->markdown('email.lupa-password-mail', [
                'url' => route('halamanLupaPassword', [
                    'email' => $this->email,
                    'type' => $this->type,
                ])
            ]);
    }
}
