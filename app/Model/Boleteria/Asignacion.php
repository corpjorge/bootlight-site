<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
  protected $table = 'asignaciones';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'admin_user_id', 'serial_id','estado_id',

  ];

  public function asignacion_admin_users()
  {
       return $this->belongsTo('App\AdminUser','admin_user_id');
  }

  public function asignacion_seriales()
  {
       return $this->belongsTo('App\Model\Boleteria\Serial', 'serial_id');
  }

  public function asignacion_estado()
  {
       return $this->belongsTo('App\Model\Sistema\Estados_aprobacion', 'estado_id');
  }
}
