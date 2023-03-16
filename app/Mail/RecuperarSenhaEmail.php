<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RecuperarSenhaEmail extends Mailable
{
    public $token;
    public $fullname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname, $token)
    {
        $this->token = $token;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.recuper_senha');
    }
}
