<?php

namespace App\Mail\SolicitudProducto;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\model\Sistema\Permiso;

class Solicitud extends Mailable
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
        $usuario = Permiso::where('area_admin_id',8)->first();
        if ($usuario) {
            return $this->view('adminlte::mail.solicitud_producto.solicitud')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Nueva Solicitud')
                    ->to($this->correo)
                    ->bcc($usuario->permiso_admin_user->email)
                    ->subject('Nueva Solicitud');
        }else{
            return $this->view('adminlte::mail.solicitud_producto.solicitud')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Nueva Solicitud')
                    ->to($this->correo)                   
                    ->subject('Nueva Solicitud');
        }
        
    }
}
