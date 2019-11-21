<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Menu_admin_sub extends Model
{
    protected $table = 'menu_admin_sub';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_admin_id', 'orden', 'areas_item_admin_id', 'icono', 'ruta', 'estado_id', 'estilo',
    ];

    public function menu_admin()
     {
         return $this->belongsTo('App\Model\Sistema\Menu_admin');
     }

    public function areas_item_admin()
     {
         return $this->belongsTo('App\Model\Sistema\Area_item_admin', 'areas_item_admin_id');
     }

    public function estado()
     {
         return $this->belongsTo('App\Model\Sistema\Estado');
     }
}
