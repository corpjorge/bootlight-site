<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Menu_user extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orden','area_id','icono', 'ruta', 'estado_id', 'estilo',
    ];

    public function menu_user_subs()
    {
        return $this->hasMany('App\Model\Sistema\Menu_users_sub');
    }

    public function estado()
    {
        return $this->belongsTo('App\Model\Sistema\Estado');
    }

    public function area()
    {
        return $this->belongsTo('App\Model\Sistema\Area', 'area_id');
    }

}
