<?php

namespace App\Mail\Boleteria;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Boleteria extends Mailable
{
    use Queueable, SerializesModels;

    public $correo,$productosname,$usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo,$productosname,$usuario)
    {
          $this->correo = $correo;
          $this->productosname = $productosname;
          $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('adminlte::mail.boleteria.boleteria')
                  ->from('seguros@fonsodi.com')
                  ->with('name','Seguros Fonsodi')
                  ->to($this->correo->correo_noti_admin_user->email)
                  ->subject('');
    }
}
