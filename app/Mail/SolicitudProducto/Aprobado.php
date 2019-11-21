<?php

namespace App\Mail\SolicitudProducto;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Aprobado extends Mailable
{
    use Queueable, SerializesModels;

    public $dato, $codigo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $dato, $codigo)
    {
        $this->correo = $correo;
        $this->dato = $dato;
        $this->codigo = $codigo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         
            return $this->view('adminlte::mail.solicitud_producto.aprobado')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Solicitud Aprobada')
                    ->to($this->correo)                   
                    ->subject('Solicitud Aprobada');       
        
    }
}
