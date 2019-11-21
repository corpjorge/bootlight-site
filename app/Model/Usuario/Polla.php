<?php

namespace App\Model\Usuario;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Polla extends Model
{
  protected $table = 'pollas';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
      
      'campeon_id' ,
      'campeon_goles' ,
      'subcampeon_id',
      'subcampeon_goles',
      'cod_asociado',
      'cedula',
      'celular',
      'terminos',
      'coutas',
      'tienda_id',
      'user_id',
      'count'
    ];
  
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function campeon()
    {
       return $this->belongsTo('App\Model\Polla\Campeon','campeon_id');
    }

    public function subcampeon()
    {
       return $this->belongsTo('App\Model\Polla\Subcampeon','subcampeon_id');
    }
    
    public function tienda()
    {
       return $this->belongsTo('App\Model\Polla\Tienda','tienda_id');
    }

}
