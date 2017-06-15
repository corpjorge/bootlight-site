<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
       'area_admin_id', 'admin_users_id',
  ];


  public function permiso_area_admin()
   {
       return $this->belongsTo('App\Model\Sistema\Area_admin', 'area_admin_id');
   }

   public function permiso_admin_user()
    {
        return $this->belongsTo('App\Model\Sistema\Estado', 'admin_users_id');
    }



}
