<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo','name',
    ];
}
