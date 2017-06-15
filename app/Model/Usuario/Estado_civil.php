<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Estado_civil extends Model
{
    protected $table = 'estado_civil';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
    ];


}
