<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordWebhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'discord_webhook', 'discord_channel_id', 'discord_category_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'discord_webhook' => 'string',
        'discord_channel_id' => 'integer',
        'discord_category_id' => 'integer'
    ];
}
