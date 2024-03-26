<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'discord_role_id', 'convoy_manager', 'atm_manager', 'team_manager', 'salary_manager', 'role_manager', 'webhook_manager'
    ];

    protected $casts = [
        'discord_role_id' => 'integer',
        'convoy_manager' => 'boolean',
        'atm_manager' => 'boolean',
        'team_manager' => 'boolean',
        'salary_manager' => 'boolean',
        'role_manager' => 'boolean',
        'webhook_manager' => 'boolean',
    ];

    public function role(): HasOne
    {
        return $this->hasOne(DiscordRole::class, 'discord_id', 'discord_role_id');
    }

    public function hasConvoyPermission(): bool
    {
        return $this->convoy_manager;
    }

    public function hasAtmPermission(): bool
    {
        return $this->atm_manager;
    }

    public function hasTeamPermission(): bool
    {
        return $this->team_manager;
    }

    public function hasSalaryPermission(): bool
    {
        return $this->salary_manager;
    }

    public function hasRolePermission(): bool
    {
        return $this->role_manager;
    }

    public function hasWebhookPermission(): bool
    {
        return $this->webhook_manager;
    }

    public function salary(): HasOne
    {
        return $this->hasOne(Salary::class, 'discord_role_id', 'discord_role_id');
    }
}
