<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'discord_id',
        'role_name',
        'role_color'
    ];

    protected $casts = [
        'id' => 'integer',
        'discord_id' => 'integer',
        'role_name' => 'string',
        'role_color' => 'string'
    ];
}
