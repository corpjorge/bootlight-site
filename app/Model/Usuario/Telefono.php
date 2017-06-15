<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'tipo', 'numero',
    ];
}
