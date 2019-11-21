<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupo extends Model
{
    protected $fillable = [
        "cedula", "email", "cupo"
    ];
    protected $table = 'cupos';

}
