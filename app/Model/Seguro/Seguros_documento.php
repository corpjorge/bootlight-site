<?php

namespace App\Model\Seguro;

use Illuminate\Database\Eloquent\Model;

class Seguros_documento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['seguros_producto_id','nombre','ruta', 'tipo', 'tamaño',];

    public function seguros_documentos()
    {
         return $this->belongsTo('App\Model\Seguro\Seguros_producto','seguros_producto_id');
    }
}
