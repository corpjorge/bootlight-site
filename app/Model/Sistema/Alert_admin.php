<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Alert_admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo','mensaje','icono','estilo', 'usuario','estado','fecha_inicio','fecha_final',

        ];



}
