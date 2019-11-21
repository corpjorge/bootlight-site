<?php

namespace App\Model\Seguro;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id','seguro_id','estado_aprobacion_id','nombre','ruta', 'tipo','tamaño','fecha_inicio','fecha_final',

      ];


    public function archivos_user()
    {
         return $this->belongsTo('App\User','user_id');
    }
    public function archivos_seguro()
    {
         return $this->belongsTo('App\Model\Seguro\Seguro','seguro_id');
    }
    public function archivos_estado()
    {
         return $this->belongsTo('App\Model\Sistema\Estados_aprobacion','estado_aprobacion_id');
    }
}
