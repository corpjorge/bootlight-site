<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Menu_admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orden','area_admin_id','icono', 'ruta', 'estado_id', 'estilo',
    ];

    public function menu_admin_sub()
    {
        return $this->hasMany('App\Model\Sistema\Menu_admin_sub','menu_admin_id');
    }
    public function estado()
    {
        return $this->belongsTo('App\Model\Sistema\Estado');
    }

    public function area_admin()
    {
        return $this->belongsTo('App\Model\Sistema\Area_admin', 'area_admin_id');
    }
}
