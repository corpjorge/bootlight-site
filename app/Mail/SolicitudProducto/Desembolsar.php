<?php

namespace App\Mail\SolicitudProducto;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Desembolsar extends Mailable
{
    use Queueable, SerializesModels;

    public $dato,$mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $dato,$mensaje)
    {
        $this->correo = $correo;
        $this->dato = $dato;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         
            return $this->view('adminlte::mail.solicitud_producto.desembolsar')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Nueva Solicitud')
                    ->to($this->correo)                   
                    ->subject('Nueva Solicitud');
        
        
    }
}
