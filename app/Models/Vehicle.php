<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'plate', 'image', 'in_use', 'is_maintained', 'is_refuel', 'is_usable_for_convoy'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'in_use' => 'boolean',
        'is_maintained' => 'boolean',
        'is_refuel' => 'boolean',
        'is_usable_for_convoy' => 'boolean'
    ];
}
