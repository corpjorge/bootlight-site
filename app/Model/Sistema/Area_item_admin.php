<?php

namespace App\Model\Sistema;

use Illuminate\Database\Eloquent\Model;

class Area_item_admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_admin_id', 'name', 'descripcion',
    ];
}
