<?php

namespace App\Model\Evento;

use Illuminate\Database\Eloquent\Model;

class Eventos_inscripcion extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id','evento_id',

      ];

  public function inscripcion_user()
  {
       return $this->belongsTo('App\User','user_id');
  }
  public function inscripcion_evento()
  {
       return $this->belongsTo('App\Model\Evento\Evento','evento_id');
  }
}
