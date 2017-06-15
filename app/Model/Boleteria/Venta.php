<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'admin_user_id', 'cuota','referencia','fecha_primer_pago',
  ];

  public function venta_user()
  {
      return $this->belongsTo('App\User','user_id');
  }
  public function venta_admin()
  {
      return $this->belongsTo('App\AdminUser','admin_user_id');
  }
  public function venta_detalle()
  {
      return $this->hasMany('App\Model\Boleteria\Venta_detalle');
  }

}
