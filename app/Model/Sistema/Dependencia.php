<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'tipo',
      ];
}
