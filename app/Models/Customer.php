<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'has_payed', 'customer_type'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'has_payed' => 'boolean',
        'customer_type' => 'integer'
    ];
}
