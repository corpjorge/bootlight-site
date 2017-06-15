<?php

namespace App\Model\Seguro;

use Illuminate\Database\Eloquent\Model;

class Seguros_producto extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name','descripcion','ruta','icono', 'estilo','info', 'img','estado_id',
      ];

  public function seguro_producto_estado()
  {
       return $this->belongsTo('App\Model\Sistema\Estado','estado_id');
  }

  public function seguro_documento()
  {
        return $this->hasMany('App\Model\Seguro\Seguros_documento');
  }


}
