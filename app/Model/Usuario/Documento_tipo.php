<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Documento_tipo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'descripcion',
    ];
}
