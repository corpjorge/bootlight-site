<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $fillable = [
        "cedula", "email", "celular", "direccion_entrega", "direccion_facturacion", "valor_compra", "fecha"
    ];
    protected $table = 'consumos';

}
