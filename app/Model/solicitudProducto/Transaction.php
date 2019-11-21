<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'account_type',
        'account',
        'opening',
        'is_principal',
        'bank_id',
        'person_id'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function people()
    {
        return $this->belongsTo(Person::class);
    }
    
    public function product()
    {
        return $this->belongTo(p_producto::class);
    }
}
