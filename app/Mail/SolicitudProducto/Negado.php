<?php

namespace App\Mail\SolicitudProducto;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Negado extends Mailable
{
    use Queueable, SerializesModels;

    public $dato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $dato)
    {
        $this->correo = $correo;
        $this->dato = $dato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         
            return $this->view('adminlte::mail.solicitud_producto.negado')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Nueva Solicitud')
                    ->to($this->correo)                   
                    ->subject('Nueva Solicitud');
        
        
    }
}
