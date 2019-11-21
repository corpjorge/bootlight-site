<?php

namespace App\model\solicitudProducto;

use Illuminate\Database\Eloquent\Model;

class p_solicitud extends Model
{
    protected $table = 'p_solicitudes';

     public function user()
  {
       return $this->belongsTo('App\User','user_id');
  }

   public function producto()
  {
       return $this->belongsTo('App\Model\solicitudProducto\p_producto','p_productos_id');
  }

   public function estado()
  {
       return $this->belongsTo('App\Model\Sistema\Estados_aprobacion','estados_id');
  }
  
    public function bank()
    {
        return $this->belongsTo('App\Model\Bank','bank_id');
    }
}
