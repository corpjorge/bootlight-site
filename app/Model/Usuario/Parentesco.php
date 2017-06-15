<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
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
