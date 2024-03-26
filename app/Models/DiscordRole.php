<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected $with = [
        'permission'
    ];
    public function permission(): HasOne
    {
        return $this->hasOne(RolePermission::class, 'discord_role_id', 'discord_id');
    }

    public function salary(): HasOne
    {
        return $this->hasOne(Salary::class, 'discord_role_id', 'discord_id');
    }
}
