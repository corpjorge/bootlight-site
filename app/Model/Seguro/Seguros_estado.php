<?php

namespace App\Model\Seguro;

use Illuminate\Database\Eloquent\Model;

class Seguros_estado extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'seguro_id','estado_aprobacion_id','observacion',

      ];

    public function seguro()
    {
         return $this->belongsTo('App\Model\Seguro\Seguro','seguro_id');
    }

    public function seguro_estado_aprobacion()
    {
         return $this->belongsTo('App\Model\Sistema\Estados_aprobacion','estado_aprobacion_id');
    }

}
