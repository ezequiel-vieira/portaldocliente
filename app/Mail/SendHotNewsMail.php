<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendHotNewsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        //dd($this->data['data']);
        return $this->from('portaldeclientes@gruponobrega.pt', 'Portal do Cliente | ANNII')
                    ->subject($this->data['fetch_type']. ' - conheça os nossos últimos produtos')
                    ->view('mail.hot_email_template')
                    ->with('data', $this->data['data']);
    }
}

