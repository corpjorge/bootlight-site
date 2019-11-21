<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';
    protected $fillable = ['name', 'code'];

    public function transactions ()
    {
        return $this->hasMany(Transaction::class);
    }
}
