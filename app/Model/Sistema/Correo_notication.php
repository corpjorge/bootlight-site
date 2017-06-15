<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Correo_notication extends Model
{
      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'area_admin_id', 'admin_user_id',
      ];

      public function correo_noti_admin_user()
      {
          return $this->belongsTo('App\AdminUser','admin_user_id');
      }



}
