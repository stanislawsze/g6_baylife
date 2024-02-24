<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordUserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'discord_role_id', 'user_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'discord_role_id' => 'integer',
        'user_id' => 'integer'
    ];

    public function roles()
    {
        return $this->belongsTo(DiscordRole::class, 'discord_role_id', 'discord_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
