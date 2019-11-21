<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Areas_item extends Model
{


      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'area_id', 'name', 'descripcion',
      ];




}
