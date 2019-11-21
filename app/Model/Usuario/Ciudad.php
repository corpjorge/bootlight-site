<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
  protected $table = 'ciudades';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
  ];
}
