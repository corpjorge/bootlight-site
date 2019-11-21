<?php

namespace App\Model\Usuario;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  protected $table = 'countries';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name','image'
  ];
}
