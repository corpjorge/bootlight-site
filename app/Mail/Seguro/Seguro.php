<?php

namespace App\Mail\Seguro;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class Seguro extends Mailable
{
    use Queueable, SerializesModels;

    public $seguro,$correo;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo,$seguro)
    {
        $this->correo = $correo;
        $this->seguro = $seguro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('adminlte::mail.seguro.seguro')
                    ->from('seguros@fonsodi.com')
                    ->with('name','Seguros Fonsodi')
                    ->to($this->correo->correo_noti_admin_user->email)
                    ->subject('');
    }
}
