<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
      protected $table = 'familiares';
      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'user_id', 'name', 'parentesco_id', 'edad',
      ];
}
