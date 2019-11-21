<?php

namespace App\model\solicitudProducto;

use Illuminate\Database\Eloquent\Model;

class p_producto extends Model
{
    protected $table = 'p_productos';
    
    protected $fillable = [
        'codigo',
        'nit',
        'name',
        'estados_id',
        'linea',
        'destinacion',
        'couta_min',
        'couta_max',
        'monto_min',
        'monto_max',
        'tipo',
        'url'
    ];
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public function estado ()
    {
         return $this->belongsTo('App\Model\Sistema\Estado','estados_id');
    }
}
