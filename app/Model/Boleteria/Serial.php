<?php

namespace App\Model\Boleteria;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\AdminUser;

class Serial extends Model
{

  protected $table = 'seriales';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'producto_id', 'numero', 'precio_compra', 'precio_publico', 'precio_venta', 'fecha_caducidad', 'admin_user_id', 'estado_actual_id', 'estado_venta', 'created_at'

  ];

  public function serial_producto()
  {
     return $this->belongsTo('App\Model\Boleteria\Producto', 'producto_id');
  }

  public function serial_estado()
  {
     return $this->belongsTo('App\Model\Sistema\Estados_aprobacion', 'estado_actual_id');
  }

    public function serial_admin()
  {
     return $this->belongsTo('App\AdminUser', 'admin_user_id');
  }

  public function serial_asignacion()
  {
     return $this->hasMany('App\Model\Boleteria\Asignacion');
  }


  public static function boletasDisponibles()
  {
    $resultado = array();
    $usuario = User::detalle();
    $useradmin = AdminUser::where('ciudad',$usuario->cuidad)->first();
    if ($useradmin == null) {
       $seriales = Serial::where('estado_actual_id','!=',5)->get();
    }
    else {
       $seriales = Serial::where('admin_user_id', $useradmin->id)->where('estado_actual_id','!=',5)->get();
    }
    foreach ($seriales as $serial) {
      array_push($resultado, $serial->serial_producto->nombre);
    }
    return $productos = array_unique($resultado);
  }



}
