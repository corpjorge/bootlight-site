<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Menu_users_sub extends Model
{
  protected $table = 'menu_users_sub';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'menu_user_id', 'orden', 'areas_item_id', 'icono', 'ruta', 'estado_id', 'estilo',
  ];

  public function menu_user()
   {
       return $this->belongsTo('App\Model\Sistema\Menu_user');
   }

  public function areas_item()
   {
       return $this->belongsTo('App\Model\Sistema\Areas_item', 'areas_item_id');
   }

  public function estado()
   {
       return $this->belongsTo('App\Model\Sistema\Estado');
   }
}
