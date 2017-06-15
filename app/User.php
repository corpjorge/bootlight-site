<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'social_name', 'email', 'password','social_id','avatar', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function usuario_rol()
    {
         return $this->belongsTo('App\Model\Sistema\Rol','role_id');
    }

    public function usuario_detalle()
    {
        return $this->hasMany('App\Model\Usuario\Users_detalle');
    }

    public function usuario_telefono()
    {
        return $this->hasMany('App\Model\Usuario\telefono', 'user_id');
    }

    public function usuario_ventas_boletas()
    {
        return $this->hasMany('App\Model\Boleteria\Venta', 'user_id');
    }

}
