<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Estado_vinculacion extends Model
{
    protected $table = 'estado_vinculacion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
    ];
}
