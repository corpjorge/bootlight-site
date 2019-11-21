<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
     protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'descripcion',
    ];
}
