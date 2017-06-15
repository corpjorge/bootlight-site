<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre', 'proveedor_id',
  ];

  public function producto_provedor()
   {
       return $this->belongsTo('App\Model\Boleteria\Proveedor', 'proveedor_id');
   }
}
