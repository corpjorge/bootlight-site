<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Estados_aprobacion extends Model
{
      protected $table = 'estados_aprobaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo','estilo',
    ];
}
