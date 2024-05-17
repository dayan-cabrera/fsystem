<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FSystemMailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($asunto, $mensaje, $attachments = [])
    {
        $this->subject($asunto);
        $this->view('emails.email')->with([
            'mensaje' => $mensaje,
            'asunto' => $asunto,
            'attachments' => $attachments
        ]);
    }

    public function build()
    {
        foreach ($this->attachments as $attachment) {
            $this->attachData($attachment, 'contenido.pdf');
        }

        return $this;
    }
}
