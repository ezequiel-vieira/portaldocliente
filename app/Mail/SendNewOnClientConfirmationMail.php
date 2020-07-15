<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewOnClientConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('portaldeclientes@gruponobrega.pt', 'Portal do Cliente')
                    ->subject('Olá, sua conta foi ativada com sucesso.')
                    ->view('mail.new_client_email_confirmation_template')
                    ->with('data', $this->data);
    }
}

