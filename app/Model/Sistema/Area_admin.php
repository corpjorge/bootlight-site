<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Area_admin extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'descripcion',
  ];

  public function permisos()
  {
      return $this->belongsToMany('App\AdminUser', 'permisos');
  }



}
