<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'discord_role_id', 'salary_patrol', 'salary_bonus', 'salary_mission'
    ];

    protected $casts = [
        'id' => 'integer',
        'salary_patrol' => 'integer',
        'salary_mission' => 'integer',
        'discord_role_id' => 'integer',
        'salary_bonus' => 'integer',
    ];
}
