<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Users_detalle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'documento_tipo_id', 'cedula', 'fecha_nacimiento', 'fecha_vinculacion', 'almacen', 'cuidad', 'genero', 'estado_vinculacion', 'estado_civil_id', 'hobby',
    ];

    public function usuario()
    {
         return $this->belongsTo('App\User','user_id');
    }
    public function usuario_estado_civil()
    {
         return $this->belongsTo('App\Model\Usuario\Estado_civil','estado_civil_id');
    }

}
