<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedores';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'linea_id','numero','nombre'
  ];

  public function proverdor_linea()
  {
      return $this->belongsTo('App\Model\Boleteria\Linea', 'linea_id');
  }
}
