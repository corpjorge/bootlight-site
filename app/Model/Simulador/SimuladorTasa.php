<?php

namespace App\Model\Simulador;

use Illuminate\Database\Eloquent\Model;

class SimuladorTasa extends Model
{
  protected $fillable = [
      'simulador_linea_id', 'valor', 'plazo_inicial','plazo_final',

  ];

  public function simuladortasa_linea()
  {
       return $this->belongsTo('App\Model\Simulador\SimuladorLinea','simulador_linea_id');
  }
}
