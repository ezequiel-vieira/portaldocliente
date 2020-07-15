<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserEncomendaMail extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->from('portaldeclientes@gruponobrega.pt', 'Portal do Cliente | Madeira Cash')
                    ->subject($this->data['assunto'])
                    ->view('mail.encomenda_client_email_template')
                    ->with('data', $this->data);
    }
}
