<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Infrastructure\BaseModel;

class Creator extends BaseModel
{
    protected $table = 'creators';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone_number',
        'username',
        'password',
        'affiliate_code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function setPasswordAttribute($value)
    {
        return Hash::make($value);
    }
}
