<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'discord_role_id', 'salary', 'salary_bonus',
    ];

    protected $casts = [
        'id' => 'integer',
        'salary' => 'integer',
        'discord_role_id' => 'integer',
        'salary_bonus' => 'integer',
    ];
}
