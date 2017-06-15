<?php

namespace App\Model\Simulador;

use Illuminate\Database\Eloquent\Model;

class SimuladorLinea extends Model
{
    protected $fillable = [
        'name', 'observacion',

    ];

    public function simuladorlinea_tasa()
    {
        return $this->hasMany('App\Model\Simulador\SimuladorTasa');
    }

}
