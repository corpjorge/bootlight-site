<?php

namespace App\Model\Evento;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title','start','end','condiciones','descripcion', 'ciudad_id','estado_id','img','url',

      ];

  public function evento_cuidades()
  {
       return $this->belongsTo('App\Model\Usuario\Ciudad','ciudad_id');
  }

  public function evento_estado()
  {
       return $this->belongsTo('App\Model\Sistema\Estado','estado_id');
  }
}
