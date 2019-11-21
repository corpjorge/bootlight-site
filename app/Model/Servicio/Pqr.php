<?php

namespace App\Model\Servicio;

use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  'user_id','tipo','descripcion','archivo','estado_id', 'observacion',

  ];

  public function pqrs_usuario()
   {
       return $this->belongsTo('App\User', 'user_id' );
   }

   public function pqrs_estado()
    {
        return $this->belongsTo('App\Model\Sistema\Estados_aprobacion', 'estado_id');
    }
}
