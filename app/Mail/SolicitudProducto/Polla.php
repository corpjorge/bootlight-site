<?php

namespace App\Mail\SolicitudProducto;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\model\Sistema\Permiso;

class Polla extends Mailable
{
    use Queueable, SerializesModels;

    public $polla;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $polla)
    {
        $this->correo = $correo;
        $this->polla = $polla;
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
            return $this->view('adminlte::mail.polla.predictions')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Prediccion Copa America Brasil 2019')
                    ->to($this->correo)
                    ->subject('Predicción');
        }else{
            return $this->view('adminlte::mail.polla.predictions')
                    ->from('webmaster@fonsodi.com')
                    ->with('name','Prediccion Copa America Brasil 2019')
                    ->to($this->correo)                   
                    ->subject('Prediccion');
        }
        
    }
}
