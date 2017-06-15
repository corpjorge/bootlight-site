<?php

namespace App\Model\Servicio;

use Illuminate\Database\Eloquent\Model;

class Clasificado extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id','titulo','descripcion','contacto','imagen','estado_id', 'observacion',

      ];

      public function clasificado_usario()
       {
           return $this->belongsTo('App\User', 'user_id' );
       }

       public function clasificado_estado()
        {
            return $this->belongsTo('App\Model\Sistema\Estados_aprobacion', 'estado_id');
        }

}
