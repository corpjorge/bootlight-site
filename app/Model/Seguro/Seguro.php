<?php

namespace App\Model\Seguro;

use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id','seguros_producto_id','estado_id','observacion_general',

      ];

    public function seguro_producto()
    {
         return $this->belongsTo('App\Model\Seguro\Seguros_producto','seguros_producto_id');
    }

    public function seguro_usuario()
    {
         return $this->belongsTo('App\User','user_id');
    }

    public function seguro_estados()
    {
          return $this->hasMany('App\Model\Seguro\Seguros_estado');
    }

    public function seguro_archivos()
    {
          return $this->hasMany('App\Model\Seguro\Archivo');
    }

    public function seguro_estado_geneal()
    {
          return $this->belongsTo('App\Model\Sistema\Estados_aprobacion', 'estado_id');
    }

}
