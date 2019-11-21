<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'venta_id', 'serial_id', 'referencia',
  ];

  public function venta()
   {
       return $this->belongsTo('App\Model\Boleteria\Venta','venta_id');
   }

   public function producto()
    {
        return $this->belongsTo('App\Model\Boleteria\Serial','serial_id');
    }

}
